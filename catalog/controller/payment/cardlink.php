<?php
class ControllerPaymentCardlink extends Controller {
	public function index() {
		$this->load->language('payment/cardlink');

		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');
		$data['installments'] = $this->language->get('installments');
		$data['select_intallemtns'] = $this->language->get('select_intallemtns');

		
		
		if ($this->config->get('cardlink_sandbox') == 1) {
			if ($this->config->get('cardlink_bank') == 0) {
				$data['action'] = 'https://euro.test.modirum.com/vpos/shophandlermpi';
			}
			else if ($this->config->get('cardlink_bank') == 1) {
				$data['action'] = 'https://alpha.test.modirum.com/vpos/shophandlermpi';
			}
		} else {
			if ($this->config->get('cardlink_bank') == 0) {
				$data['action'] = '';
			}
			else if ($this->config->get('cardlink_bank') == 1) {
				$data['action'] = '';
			}
		}
		
		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$data['opencart_theme'] = $this->config->get('theme_default_directory');
		if ($data['opencart_theme'] == "journal2") {
			$data['ajax_call_route'] = "journal2/checkout/cart";
			$data['confirm_button'] = "journal-checkout-confirm-button";
		}
		else {
			$data['ajax_call_route'] = "checkout/confirm";
			$data['confirm_button'] = "default-btn-primary";
		}
		
		if ($order_info) {
			$data['mid'] = $this->config->get('cardlink_mid');
			$data['confirmUrl'] = $this->url->link('payment/cardlink/callback', '', true);
			$data['cancelUrl'] = $this->url->link('payment/cardlink/callback', '', true);
			$data['extInstallmentperiod'] = $this->config->get('cardlink_installments');
			$data['minimum_installments_cost'] = $this->config->get('cardlink_minimum_installments_cost');
			$data['cardlink_digest'] = $this->config->get('cardlink_digest');
			$data['currency_code'] = $order_info['currency_code'];
			$data['orderAmount'] = round($order_info['total'],2);
			$data['orderDesc'] = "Cart checkout";
			$data['order_id'] = $this->session->data['order_id'];			
			
			if ($order_info['total'] < $this->config->get('cardlink_minimum_installments_cost')) {
				$this->session->data['cardlink_selected_installments'] = "";
				$data['cardlink_selected_installments'] = $this->session->data['cardlink_selected_installments'];
				$data['extInstallmentoffset'] = "";
			}
			else {
				if (!isset($this->session->data['cardlink_selected_installments']) ) {
					$this->session->data['cardlink_selected_installments'] = "";
          $data['extInstallmentoffset'] = "";
				}
				$data['cardlink_selected_installments'] = $this->session->data['cardlink_selected_installments'];
				if ($this->session->data['cardlink_selected_installments'] == "" ) {
          $data['extInstallmentoffset'] = "";
        }
        else {
          $data['extInstallmentoffset'] = 0;
        }
			}

			return $this->load->view('payment/cardlink', $data);
		}
	}

	public function callback() {
		if (isset($this->request->post['orderid'])) {
			$order_id = $this->request->post['orderid'];
		} else {
			$order_id = 0;
		}

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($order_id);
						
		$post_data_array = array();

		if (isset($_POST['mid'])) {$post_data_array[0] = $_POST['mid'];}
		if (isset($_POST['orderid'])) {$post_data_array[1] = $_POST['orderid'];}
		if (isset($_POST['status'])) {$post_data_array[2] = $_POST['status'];}
		if (isset($_POST['orderAmount'])) {$post_data_array[3] = $_POST['orderAmount'];}
		if (isset($_POST['currency'])) {$post_data_array[4] = $_POST['currency'];}
		if (isset($_POST['paymentTotal'])) {$post_data_array[5] = $_POST['paymentTotal'];}
		if (isset($_POST['message'])) {$post_data_array[6] = $_POST['message'];}
		if (isset($_POST['riskScore'])) {$post_data_array[7] = $_POST['riskScore'];}
		if (isset($_POST['payMethod'])) {$post_data_array[8] = $_POST['payMethod'];}
		if (isset($_POST['txId'])) {$post_data_array[9] = $_POST['txId'];}
		if (isset($_POST['paymentRef'])) {$post_data_array[10] = $_POST['paymentRef'];}
		$post_data_array[11] = "Cardlink1";
	
		$post_DIGEST = $_POST['digest'];
		
		$post_data = implode("", $post_data_array);
		$digest = base64_encode(sha1($post_data,true));

		if ($order_info && $post_DIGEST == $digest) {
			if ($this->request->post['status'] == "AUTHORIZED" || $this->request->post['status'] == "CAPTURED") {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'));
				unset($this->session->data['cardlink_selected_installments']);
				return $this->response->redirect($this->url->link('checkout/success'));
			}
			else if ($this->request->post['status'] == "CANCELED" || $this->request->post['status'] == "REFUSED" || $this->request->post['status'] == "ERROR") {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_fraud_status_id'));
				unset($this->session->data['order_id']);
				unset($this->session->data['cardlink_selected_installments']);
				return $this->response->redirect($this->url->link('checkout/failure'));
			}
		}
	}
	
	public function saveInstallments() {
		if ($this->request->post['cardlink_installments'] <= $this->config->get('cardlink_installments')) {
			$this->session->data['cardlink_selected_installments'] = $this->request->post['cardlink_installments'];	
		}		
	}
}