<?php
declare(strict_types=1);

function getDashboardStats(PDO $pdo, array $schema): array
{
    $result = ['orders' => 0, 'revenue' => 0.0, 'menus' => 0, 'activeEmployees' => 0];
    try {
        $result['orders'] = (int)$pdo->query('SELECT COUNT(*) FROM `' . $schema['orders_table'] . '`')->fetchColumn();
        $result['revenue'] = (float)$pdo->query('SELECT COALESCE(SUM(`' . $schema['order_total'] . '`),0) FROM `' . $schema['orders_table'] . '`')->fetchColumn();
        $result['menus'] = (int)$pdo->query('SELECT COUNT(*) FROM `' . $schema['menus_table'] . '`')->fetchColumn();
        $result['activeEmployees'] = (int) $pdo->query(
         "SELECT COUNT(*)
        FROM `utilisateurs`
        WHERE `statut` = 1
        AND LOWER(`role`) IN ('employé', 'employe', 'employee')"
        )->fetchColumn();
    } catch (PDOException $exception) {
        error_log('Statistiques tableau de bord : ' . $exception->getMessage());
    }
    return $result;
}

function getMenuStatistics(PDO $pdo, array $schema, string $period, string $menuFilter): array
{
    $dateColumn = '`c`.`' . $schema['order_date'] . '`';
    $where = [];
    $params = [];

    if ($period === 'month') {
        $where[] = $dateColumn . ' >= :start_date';
        $params[':start_date'] = date('Y-m-01 00:00:00');
    } elseif ($period === 'year') {
        $where[] = $dateColumn . ' >= :start_date';
        $params[':start_date'] = date('Y-01-01 00:00:00');
    }

    if ($menuFilter !== 'all' && ctype_digit($menuFilter)) {
        $where[] = '`m`.`' . $schema['menu_id'] . '` = :menu_id';
        $params[':menu_id'] = (int)$menuFilter;
    }

    $sql = 'SELECT m.`' . $schema['menu_id'] . '` AS menu_id, m.`' . $schema['menu_name'] . '` AS menu_name, COUNT(c.`' . $schema['order_id'] . '`) AS order_count, COALESCE(SUM(c.`' . $schema['order_total'] . '`),0) AS revenue
            FROM `' . $schema['menus_table'] . '` m
            LEFT JOIN `' . $schema['orders_table'] . '` c ON c.`' . $schema['order_menu_id'] . '` = m.`' . $schema['menu_id'] . '`'
            . (count($where) ? ' WHERE ' . implode(' AND ', $where) : '')
            . ' GROUP BY m.`' . $schema['menu_id'] . '`, m.`' . $schema['menu_name'] . '` ORDER BY revenue DESC';

    try {
        $statement = $pdo->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll();
    } catch (PDOException $exception) {
        error_log('Statistiques par menu : ' . $exception->getMessage());
        return [];
    }
}

function syncStatisticsToMongo(?object $collection, array $rows, string $period): bool
{
    if ($collection === null) {
        return false;
    }

    try {
        $collection->deleteMany(['period' => $period]);
        foreach ($rows as $row) {
            $collection->insertOne([
                'menu_id' => (int)$row['menu_id'],
                'menu_name' => (string)$row['menu_name'],
                'order_count' => (int)$row['order_count'],
                'revenue' => (float)$row['revenue'],
                'period' => $period,
                'generated_at' => new \MongoDB\BSON\UTCDateTime(),
            ]);
        }
        return true;
    } catch (Throwable $exception) {
        error_log('Synchronisation MongoDB : ' . $exception->getMessage());
        return false;
    }
}
