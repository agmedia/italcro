<?php



class ControllerExtensionFeedJeftinije extends Controller
{
    
    public function index()
    {
		// The legacy feed was public, ignored buyer-only visibility rules and used
		// OpenCart specials instead of the Rev3 pricing policy. Keep it closed until
		// an authenticated feed contract and an explicit price policy are approved.
		http_response_code(404);
		$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');
		$this->response->addHeader('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
		$this->response->addHeader('Pragma: no-cache');
		$this->response->setOutput('');
    }
    
    
    private function wrapInCDATA($in)
    {
        return "<![CDATA[". $in ."]]>";
    }
    
    
    private function removeChar($string, $char)
    {
        return str_replace($char, '', $string);
    }


    public function getProductImages($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

        return $query->rows;
    }
    
    
    /**
     * Construct category and parent name
     * and return it
     *
     * @param $id
     *
     * @return string
     */
    public function getCategoriesName($id)
    {
        $this->load->model('catalog/category');
        $data = $this->model_catalog_product->getCategories($id);
        $name = '';



        
        foreach ($data as $key => $item) {
            if (empty($category)) {

              if($key != 0){

                $category = $this->model_catalog_category->getCategory($item['category_id']);

                $name     = $category['name'];
                
                if ($category['parent_id'] != 0) {
                    $parent = $this->model_catalog_category->getCategory($category['category_id']);
                    $name   =  $category['name'];
                }


              }
              
            }
        }
        
        return $name;
    }
    
}

?>
