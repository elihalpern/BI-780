<html>
    <body>
        <?php
            $searchTerms = $_GET['searchTerms'];
            $url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&retmax=1000&term='.urlencode($searchTerms);
            echo $url;
        ?>
    </body>
</html>