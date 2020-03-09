<?php

class RequestModel
{
    const REQUESTS_XML = "requests.xml";

    /**
     * @param array $data
     */
    public function insertXML($data)
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->load(self::REQUESTS_XML);

        $root = $doc->documentElement;
        $totalRequest = $root->getAttribute('ids');
        $node = $doc->createElement("request");
        $node->setAttribute("id", $totalRequest);
        $totalRequest++;
        $root->setAttribute("ids", $totalRequest);

        foreach ($data as $key => $value) {
            $node->appendChild($doc->createElement($key, $value));
        }
        $root->appendChild($node);

        $doc->save(self::REQUESTS_XML);
    }

    /**
     * @param string $id
     */
    public function deleteXML($id)
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->load(self::REQUESTS_XML);

        $root = $doc->documentElement;
        $request = $root->getElementsByTagName('request');

        foreach ($request as $nodeToRemove) {
            if ($nodeToRemove->getAttribute('id') == $id) {
                $root->removeChild($nodeToRemove);
                break;
            }
        }

        $doc->save(self::REQUESTS_XML);
    }

    /**
     * @param string|null $name
     * @param string|null $order
     * @return array
     */
    public function getXML($name = null, $order = null)
    {
        $xml = simplexml_load_file(self::REQUESTS_XML);
        $res = [];
        foreach ($xml->request as $item) {
            $res[] = [
                'id' => (string)$item->attributes()->id,
                'fname' => (string)$item->fname,
                'lname' => (string)$item->lname,
                'email' => (string)$item->email,
                'tel' => (string)$item->tel,
                'picture' => (string)$item->picture,
            ];
        }

        if ($name !== null && $order !== null) {
            $res = $this->sortArrCol($res, $name, $order);
        }

        return $res;
    }

    /**
     * @param array $arr
     * @param string $nameColumn
     * @param string $order
     * @return array
     */
    private function sortArrCol($arr, $nameColumn, $order)
    {
        $columnSort = array_column($arr, $nameColumn);

        array_multisort($columnSort, $this->getNumberSort($order), $arr);

        return $arr;
    }

    /**
     * @param string $sort
     * @return int
     */
    private function getNumberSort($sort)
    {
        return $sort === 'asc' ? SORT_ASC : SORT_DESC;
    }
}
