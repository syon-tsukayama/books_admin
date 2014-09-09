<?php
/**
 * RSS取得処理
 * WebAPI：国立国会図書館サーチ（OpenSearch）を利用した図書情報検索
 *
 */

// 名前空間
define('NS_DCMITYPE', 'http://purl.org/dc/dcmitype/');
define('NS_RDFS', 'http://www.w3.org/2000/01/rdf-schema#');
define('NS_XSI', 'http://www.w3.org/2001/XMLSchema-instance');
define('NS_OPENSEARCH', 'http://a9.com/-/spec/opensearchrss/1.0/');
define('NS_DC', 'http://purl.org/dc/elements/1.1/');
define('NS_DCNDL', 'http://ndl.go.jp/dcndl/terms/');
define('NS_RDF', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
define('NS_RCTERMS', 'http://purl.org/dc/terms/');

$input_isbn = '';
if(php_sapi_name() == 'cli')
{
    // ISBNコード取得
    if(isset($argv[1]) && !empty($argv[1]))
    {
        $input_isbn = trim($argv[1]);
    }
}
else
{
    // ISBNコード取得
    if(isset($_GET['isbn']) && !empty($_GET['isbn']))
    {
        $input_isbn = trim($_GET['isbn']);
    }
}

$items = array();

if(!empty($input_isbn))
{
    $request_url = 'http://iss.ndl.go.jp/api/opensearch'.'?isbn='.$input_isbn;

    $xml = simplexml_load_file($request_url);

    if(!empty($xml))
    {
        if(count($xml->channel->item) > 0)
        {
            foreach($xml->channel->item as $item)
            {
                $node = $item->children(NS_DC);

                $isbn = '';

                foreach($node->identifier as $id)
                {
                    if(preg_match('/ISBN/iu', (string)$id->attributes(NS_XSI)) == 1)
                    {
                        $isbn = (string)$id;
                    }
                }
                if($isbn == '')
                {
                    continue;
                }

                $items[$isbn]['title'] = (string)$node->title;
                $items[$isbn]['author'] = (string)$node->creator;
                $items[$isbn]['publisher'] = (string)$node->publisher;
                $items[$isbn]['NDC'] = '';
                foreach($node->subject as $id)
                {
                    if (preg_match('/NDC/iu', (string)$id->attributes(NS_XSI)) == 1)
                    {
                        $items[$isbn]['NDC'] = (string)$id;
                    }
                }
                $items[$isbn]['url'] = (string)$item->link;
                $items[$isbn]['pubDate'] = (string)$item->pubDate;
                $node = $item->children(NS_DCNDL);

                if($node->volume != '')
                {
                    $items[$isbn]['title'] = $items[$isbn]['title'] . '（' . (string)$node->volume . '）';
                }
            }
        }
    }
}

echo json_encode($items);

