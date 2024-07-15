<table>
    <thead>
        <tr>
            <?php foreach ($headers as $header): ?>
                <th class="<?= $header; ?>">                            
                    <form class="hidden" method="post" id="entetes<?= $header ?>" action="">
                        <input type="hidden" name="colonne" value="<?= $header; ?>"/>
                        <input type="hidden" name="ordre" value="<?= $order === 'asc' ? 'dsc' : 'asc'; ?>"/>
                    </form>
                    <a href="#" onclick='document.getElementById("entetes<?= $header ?>").submit()'>
                        <?= ucfirst($header); ?>
                        <?= $order === 'asc' ? '▼' : '▲'; ?>
                    </a>
                </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas as $data): ?>
            <tr>
                <?php foreach ($headers as $header): ?>
                    <td class="<?= $header; ?>">
                        <?php 
                        if(is_object(self::getProperty($data, $header))){
                            echo (ucfirst(Utils::convertDateToFrenchFormat(self::getProperty($data, $header))));
                        } else {
                            echo (self::getProperty($data, $header));
                        } 
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>