<?php

class DashboardManager extends AbstractEntityManager
{
    public function getAllArticlesForDashBoard() : array
    {
        $sql = "SELECT article.*, COUNT(comment.id) as commentNumber 
        FROM article 
        LEFT JOIN comment ON article.id = comment.id_article 
        GROUP BY article.id ";
        $result = $this->db->query($sql);
        $articles = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $dashboard = new Dashboard(
                $row['title'],
                $row['views'],
                $row['commentNumber'],
                new DateTime($row['date_creation'])
            );
            $dashboards[] = $dashboard;
        }
        return $dashboards;
    }
}