<?php
class ControllerProductCategory extends Controller {

    public function index() {
        $this->load->language('product/category');

        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = '';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort_order';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = (int)$this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = (int)$this->request->get['limit'];
        } else {
            $limit = (int)$this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit');
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        if (isset($this->request->get['path'])) {
            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $path = '';

            $parts = explode('_', (string)$this->request->get['path']);

            $category_id = (int)array_pop($parts);

            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = (int)$path_id;
                } else {
                    $path .= '_' . (int)$path_id;
                }

                $category_info_breadcrumb = $this->model_catalog_category->getCategory($path_id);

                if ($category_info_breadcrumb) {
                    $data['breadcrumbs'][] = array(
                        'text' => $category_info_breadcrumb['name'],
                        'href' => $this->url->link('product/category', 'path=' . $path . $url)
                    );
                }
            }
        } else {
            $category_id = 0;
        }

        $store_id = (int)$this->config->get('config_store_id');
        $lang_id  = (int)$this->config->get('config_language_id');

        $catver   = $this->catCacheVersion($category_id);
        $base_cat = "cat.$store_id.$lang_id.$category_id.v$catver";

        // ===== category info cache =====
        $key = $base_cat . ".info";
        $category_info = $this->cget($key);
        if ($category_info === false) {
            $category_info = $this->model_catalog_category->getCategory($category_id);
            $this->cset($key, $category_info);
        }

        if ($category_info) {
            $this->document->setTitle($category_info['meta_title']);
            $this->document->setDescription($category_info['meta_description']);
            $this->document->setKeywords($category_info['meta_keyword']);

            $data['heading_title'] = $category_info['name'];

            if ($page >= 2) {
                $this->document->setRobots('noindex,follow');
            } else {
                $this->document->setRobots('index,follow');
            }

            $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));

            // last breadcrumb
            $data['breadcrumbs'][] = array(
                'text' => $category_info['name'],
                'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'])
            );

            if ($category_info['image']) {
                $data['thumb'] = $this->model_tool_image->resize(
                    $category_info['image'],
                    $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'),
                    $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height')
                );
            } else {
                $data['thumb'] = '';
            }

            $data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
            $data['short_description'] = html_entity_decode($category_info['short_description'], ENT_QUOTES, 'UTF-8');
            $data['compare'] = $this->url->link('product/compare');

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            // ===== subcats cache (s countom) =====
            $key = $base_cat . ".subcats_with_counts";
            $subcats = $this->cget($key);

            if ($subcats === false) {
                $subcats = [];
                $results = $this->model_catalog_category->getCategories($category_id);

                foreach ($results as $result) {
                    $filter_data_count = array(
                        'filter_category_id'  => (int)$result['category_id'],
                        'filter_sub_category' => true
                    );

                    $count = $this->config->get('config_product_count')
                        ? (int)$this->model_catalog_product->getTotalProducts($filter_data_count)
                        : 0;

                    $subcats[] = array(
                        'category_id' => (int)$result['category_id'],
                        'name'        => $result['name'],
                        'count'       => $count
                    );
                }

                $this->cset($key, $subcats);
            }

            $data['categories'] = array();
            foreach ($subcats as $sc) {
                $data['categories'][] = array(
                    'name' => $sc['name'] . ($this->config->get('config_product_count') ? ' (' . $sc['count'] . ')' : ''),
                    'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $sc['category_id'] . $url)
                );
            }

            // ===== products listing cache =====
            $filter_data = array(
                'filter_category_id' => $category_id,
                'filter_filter'      => $filter,
                'sort'               => $sort,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,
                'limit'              => $limit
            );

            $catalogver = $this->catalogCacheVersion();

            $currency = isset($this->session->data['currency']) ? $this->session->data['currency'] : '';
            $logged   = $this->customer->isLogged() ? 1 : 0;

            $customer_group_id = (int)($logged ? $this->customer->getGroupId() : $this->config->get('config_customer_group_id'));

            $list_key_base =
                "catlist.$store_id.$lang_id.$category_id.cv$catalogver" .
                ".f" . md5($filter . '|' . $sort . '|' . $order) .
                ".p$page.l$limit" .
                ".cur$currency.g$customer_group_id.lg$logged";

            $key = $list_key_base . ".total";
            $product_total = $this->cget($key);
            if ($product_total === false) {
                $product_total = (int)$this->model_catalog_product->getTotalProducts($filter_data);
                $this->cset($key, $product_total);
            }

            $key = $list_key_base . ".products";
            $results = $this->cget($key);
            if ($results === false) {
                $results = $this->model_catalog_product->getProducts($filter_data);
                $this->cset($key, $results);
            }

            // attention računaj jednom
            $data['attention'] = ($this->config->get('config_customer_price') && !$this->customer->isLogged()) ? '1' : '';

            $data['products'] = array();

            foreach ($results as $result) {
                if (!empty($result['image'])) {
                    $image = $this->model_tool_image->resize(
                        $result['image'],
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'),
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')
                    );
                } else {
                    $image = $this->model_tool_image->resize(
                        'placeholder.png',
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'),
                        $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')
                    );
                }

                if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format(
                        $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')),
                        $this->session->data['currency']
                    );
                } else {
                    $price = false;
                }

                if (!is_null($result['special']) && (float)$result['special'] >= 0) {
                    $special = $this->currency->format(
                        $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')),
                        $this->session->data['currency']
                    );
                    $tax_price = (float)$result['special'];
                } else {
                    $special = false;
                    $tax_price = (float)$result['price'];
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format($tax_price, $this->session->data['currency']);
                } else {
                    $tax = false;
                }

                // ===== preview price (tvoj blok) =====
                $minimum = $result['minimum'] > 0 ? (int)$result['minimum'] : 1;

                $price_raw   = (float)$result['price'];
                $special_raw = (float)$result['special'];

                $preview_price_alt = false;

                if ($special_raw > 0) {
                    $preview_price_raw = $special_raw * $minimum;
                    $preview_price_alt_raw = $price_raw * $minimum;

                    $preview_price_alt = $this->currency->format(
                        $this->tax->calculate($preview_price_alt_raw, $result['tax_class_id'], $this->config->get('config_tax')),
                        $this->session->data['currency']
                    );
                } else {
                    $preview_price_raw = $price_raw * $minimum;
                }

                $preview_price = ($preview_price_raw > 0) ? $this->currency->format(
                    $this->tax->calculate($preview_price_raw, $result['tax_class_id'], $this->config->get('config_tax')),
                    $this->session->data['currency']
                ) : false;

                $data['products'][] = array(
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'name'        => $result['name'],
                    'name_add'    => isset($result['name_add']) ? $result['name_add'] : '',
                    'price'       => $price,
                    'mpn_count'   => isset($result['mpn_count']) ? $result['mpn_count'] : 0,
                    'mpn_artikl'  => $this->artiklLabel(isset($result['mpn_count']) ? $result['mpn_count'] : 0),
                    'cent'        => isset($result['cent']) ? $result['cent'] : '',
                    'sku'         => isset($result['sku']) ? $result['sku'] : '',
                    'special'     => $special,

                    // NEW
                    'preview_price'     => $preview_price,
                    'preview_price_alt' => $preview_price_alt,

                    'attention'   => $data['attention'],
                    'tax'         => $tax,
                    'minimum'     => $minimum,
                    'rating'      => isset($result['rating']) ? $result['rating'] : 0,
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
                );
            }

            // ===== sorts/limits/pagination (tvoj original) =====
            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $data['sorts'] = array();

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_default'),
                'value' => 'p.sort_order-ASC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_name_asc'),
                'value' => 'pd.name-ASC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_name_desc'),
                'value' => 'pd.name-DESC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_price_asc'),
                'value' => 'p.price-ASC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_price_desc'),
                'value' => 'p.price-DESC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
            );

            if ($this->config->get('config_review_status')) {
                $data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_desc'),
                    'value' => 'rating-DESC',
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
                );

                $data['sorts'][] = array(
                    'text'  => $this->language->get('text_rating_asc'),
                    'value' => 'rating-ASC',
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
                );
            }

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_model_asc'),
                'value' => 'p.model-ASC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
            );

            $data['sorts'][] = array(
                'text'  => $this->language->get('text_model_desc'),
                'value' => 'p.model-DESC',
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
            );

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            $data['limits'] = array();

            $limits = array_unique(array((int)$this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));
            sort($limits);

            foreach ($limits as $value) {
                $data['limits'][] = array(
                    'text'  => $value,
                    'value' => $value,
                    'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . (int)$value)
                );
            }

            $url = '';

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $pagination = new Pagination();
            $pagination->total = $product_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf($this->language->get('text_pagination'),
                ($product_total) ? (($page - 1) * $limit) + 1 : 0,
                ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit),
                $product_total,
                ceil($product_total / $limit)
            );

            // canonical/prev/next
            if ($page == 1) {
                $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id']), 'canonical');
            } else {
                $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page=' . $page), 'canonical');
            }

            if ($page > 1) {
                $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . (($page - 2) ? '&page=' . ($page - 1) : '')), 'prev');
            }

            if ($limit && ceil($product_total / $limit) > $page) {
                $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page=' . ($page + 1)), 'next');
            }

            $data['sort']  = $sort;
            $data['order'] = $order;
            $data['limit'] = $limit;

            $data['continue'] = $this->url->link('common/home');

            $data['column_left']   = $this->load->controller('common/column_left');
            $data['column_right']  = $this->load->controller('common/column_right');
            $data['content_top']   = $this->load->controller('common/content_top');
            $data['content_bottom']= $this->load->controller('common/content_bottom');
            $data['footer']        = $this->load->controller('common/footer');
            $data['header']        = $this->load->controller('common/header');

            $this->response->setOutput($this->load->view('product/category', $data));

        } else {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }
            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }
            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }
            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            if (isset($this->request->get['limit'])) {
                $url .= '&limit=' . $this->request->get['limit'];
            }

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_error'),
                'href' => $this->url->link('product/category', $url)
            );

            $this->document->setTitle($this->language->get('text_error'));

            $data['continue'] = $this->url->link('common/home');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $data['column_left']   = $this->load->controller('common/column_left');
            $data['column_right']  = $this->load->controller('common/column_right');
            $data['content_top']   = $this->load->controller('common/content_top');
            $data['content_bottom']= $this->load->controller('common/content_bottom');
            $data['footer']        = $this->load->controller('common/footer');
            $data['header']        = $this->load->controller('common/header');

            $this->response->setOutput($this->load->view('error/not_found', $data));
        }
    }

    function artiklLabel($broj) {
        $broj = abs((int)$broj) % 100;
        $jedinica = $broj % 10;

        if ($broj > 10 && $broj < 20) return "artikala";
        if ($jedinica == 1) return "artikl";
        if ($jedinica >= 2 && $jedinica <= 4) return "artikla";
        return "artikala";
    }

    private function catCacheVersion($category_id) {
        $key = 'catver.' . (int)$category_id;
        $ver = $this->cache->get($key);

        if ($ver === false || $ver === null) {
            $ver = 1;
            $this->cache->set($key, $ver);
        }

        return (int)$ver;
    }

    private function catalogCacheVersion() {
        $key = 'catalogver';
        $ver = $this->cache->get($key);

        if ($ver === false || $ver === null) {
            $ver = 1;
            $this->cache->set($key, $ver);
        }

        return (int)$ver;
    }

    private function cget($key) {
        $v = $this->cache->get($key);
        return ($v === false || $v === null) ? false : $v;
    }

    private function cset($key, $value) {
        $this->cache->set($key, $value);
        return $value;
    }
}
