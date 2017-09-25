<html>
    <link rel="stylesheet" href="abstracts.css">
    <body>
        <div>
            <h1>Results:</h1>
            <?php
                define('SIZE', 1000);
                if(strlen($_GET['searchTerms']) == 0)
                {
                    echo '<h2>Please enter some search terms!</h2>';
                    trigger_error("Please enter some search terms!", E_USER_ERROR);
                }
                $searchTerms = $_GET['searchTerms'];
                $url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&retmax='.SIZE.'&term='.urlencode($searchTerms);
                $json = file_get_contents($url);
                $data = json_decode($json);
                $count = $data->esearchresult->count;
                if(strlen($_GET['maxDocs']) > 0)
                {
                    $usercount = $_GET['maxDocs'];
                    if(!is_numeric($usercount) || (int)$usercount != (double)$usercount)
                    {
                        echo '<h2>Must be an integer!</h2>';
                        trigger_error("Must be an integer!", E_USER_ERROR);
                    }
                    elseif($usercount > $count)
                    {
                        echo '<h2>Number too large!</h2>';
                        trigger_error("Number too large!", E_USER_ERROR);
                    }
                    else
                    {
                        $count = $usercount;
                    }
                }
                if($count <= 0)
                {
                    echo '<h2>Must be 1 or above!</h2>';
                    trigger_error("Must be 1 or above!", E_USER_ERROR);
                }
                echo '<h2>'.$count.' result';
                if($count != 1)
                {
                    echo 's';
                }
                echo ' shown.</h2>';
                for($i = 0; $i < $count; $i+=SIZE)
                {
                    $url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&retmax='.SIZE.'&retstart='.$i.'&term='.urlencode($searchTerms);
                    $json = file_get_contents($url);
                    $data = json_decode($json);
                    $idlist = $data->esearchresult->idlist;
                    if(($count - $i) > 1000)
                    {
                        foreach($data->esearchresult->idlist as $id)
                        {
                            $abstract = file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&retmode=text&rettype=abstract&id='.$id);
                            echo '<p>'.$abstract.'</p>';
                        }
                    }
                    else
                    {
                        for($j = 0; $j < $count; $j++)
                        {
                            $id = $data->esearchresult->idlist[$j];
                            $abstract = file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&retmode=text&rettype=abstract&id='.$id);
                            echo '<p>'.$abstract.'</p>';
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>