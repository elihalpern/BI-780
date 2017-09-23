<html>
    <body>
        <?php
            define('SIZE', 1000);
            $searchTerms = $_GET['searchTerms'];
            $url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&retmax='.SIZE.'&term='.urlencode($searchTerms);
            $json = file_get_contents($url);
            $data = json_decode($json);
            $count = $data->esearchresult->count;
            for($i = 0; $i < $count; $i+=SIZE)
            {
                $url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&retmax='.SIZE.'&retstart='.$i.'&term='.urlencode($searchTerms);
                $json = file_get_contents($url);
                $data = json_decode($json);
                foreach($data->esearchresult->idlist as $id)
                {
                    $abstract = file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&retmode=text&rettype=abstract&id='.$id);
                    echo '<p>'.$abstract.'</p>';
                }
            }
        ?>
    </body>
</html>