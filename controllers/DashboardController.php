<?php
/*
 * Permet de gérer l'affichage du tableau de bord avec des options de tri.
 */
class DashboardController
{
    public function showDashboard()
    {
        /*
         * Récupère les paramètres de tri depuis l'URL.
         * Par défaut, trie par 'title' en ordre 'asc'.
         */
        $sortBy = $_GET['sort'] ?? 'title';
        $order = $_GET['order'] ?? 'asc';

        /*
         * Tableau avec les paramètres de tri.
         */
        $allowedSorts = ['title', 'views', 'comments', 'date'];
        $allowedOrders = ['asc', 'desc'];

        /*
         * Attribution des valeurs par défaut si les paramètres sont invalides.
         */
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'title';
        }
        if (!in_array($order, $allowedOrders)) {
            $order = 'asc';
        }

        $dashboardManager = new DashboardManager();
        $dashboards = $dashboardManager->getAllArticlesForDashBoard();

        /*
         * Tri des articles en fonction des paramètres de l'url.
         */
        usort($dashboards, function($a, $b) use ($sortBy, $order) {
            switch ($sortBy) {
                case 'views':
                    $result = $a->getVueNumber() <=> $b->getVueNumber();
                    break;
                case 'comments':
                    $result = $a->getCommentNumber() <=> $b->getCommentNumber();
                    break;
                case 'date':
                    $result = $a->getDateCreation() <=> $b->getDateCreation();
                    break;
                case 'title':
                default:
                    $result = strcasecmp($a->getTitle(), $b->getTitle());
                    break;
            }
            return $order === 'desc' ? -$result : $result;
        });

        /*
         * Préparation des URLs de tri pour les en-têtes de colonnes.
         */
        $sortData = $this->prepareSortData($sortBy, $order);

        $view = new View("Dashboard");
        $view->render("dashboard", [
            'dashboards' => $dashboards,
            'sortUrls' => $sortData['urls'],
        ]);
    }

    /*
     * Prépare les URLs de tri pour chaque colonne du tableau de bord.
     */
    private function prepareSortData(string $currentSort, string $currentOrder): array
    {
        $columns = ['title', 'views', 'comments', 'date'];
        $urls = [];
        foreach ($columns as $column) {
            $newOrder = ($column === $currentSort && $currentOrder === 'asc') ? 'desc' : 'asc';
            $urls[$column] = "index.php?action=dashboard&sort={$column}&order={$newOrder}";
        }

        return ['urls' => $urls];
    }
}
