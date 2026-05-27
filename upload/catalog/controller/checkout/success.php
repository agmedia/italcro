<?php
class ControllerCheckoutSuccess extends Controller {
	public function index() {
		$this->load->language('checkout/success');
		$data['clear_quick_order'] = false;

		if (isset($this->session->data['order_id'])) {

			  $order_id = $this->session->data['order_id'];

			$this->cart->clear();
			$data['clear_quick_order'] = true;

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
		//	unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		if ($this->customer->isLogged()) {
			$data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', true), $this->url->link('account/order', '', true), $this->url->link('account/download', '', true), $this->url->link('information/contact'));
		} else {
			$data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->load->model('checkout/order');

		if(isset($order_id)){



	        $oc_order = $this->model_checkout_order->getOrder($order_id);

	        $data['paymethod'] = $oc_order['payment_code'];
	        $data['order_id'] = $order_id;


	         $this->load->model('account/order');
	        // Totals
	        $data['totals'] = array();

	        $totals = $this->model_account_order->getOrderTotals($order_id);

	        foreach ($totals as $total) {


	            if ($total['title']=='Ukupno'){

	                $ukupno = $this->currency->format($total['value'], $oc_order['currency_code'], $oc_order['currency_value']);
	                $ukupnohub = number_format((float)$total['value'], 2, '.', '');
	                $ukupnohub = $ukupnohub * 100;
	            }

	            if($oc_order['currency_code']=='HRK'){
	                $text =  $this->currency->format($total['value'], $oc_order['currency_code'], $oc_order['currency_value']).' <small>('.$this->currency->format($total['value'], 'EUR'). ')</small> ';
	            }
	            else{
	                $text = $this->currency->format($total['value'], $oc_order['currency_code'], $oc_order['currency_value']);
	            }


	            $data['totals'][] = array(
	                'title' => $total['title'],
	                'text'  => $text,
	            );
	        }







	   /// orderinoend
	        if (isset($data['paymethod']) && $data['paymethod'] == 'bank_transfer') {
	            $data['text_message'] = sprintf($this->language->get('text_bank'), $order_id);
	        }



	}


        unset($this->session->data['order_id']);





		$this->response->setOutput($this->load->view('common/success', $data));
	}
}
