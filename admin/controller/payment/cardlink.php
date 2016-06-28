<?php
class ControllerPaymentCardlink extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/cardlink');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			unset($this->session->data['error_payment']);
			
			$this->model_setting_setting->editSetting('cardlink', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['entry_mid'] = $this->language->get('entry_mid');
		$data['entry_confirmUrl'] = $this->language->get('entry_confirmUrl');
		$data['entry_cancelUrl'] = $this->language->get('entry_cancelUrl');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['installments'] = $this->language->get('installments');
		$data['minimum_installments_cost'] = $this->language->get('minimum_installments_cost');
		$data['installments_tip'] = $this->language->get('installments_tip');
		$data['installments_number_tip'] = $this->language->get('installments_number_tip');
		$data['sandbox'] = $this->language->get('sandbox');
		$data['bank'] = $this->language->get('bank');
		$data['alphabank'] = $this->language->get('alphabank');
		$data['eurobank'] = $this->language->get('eurobank');
		$data['help_sanbox'] = $this->language->get('help_sanbox');
		$data['digest'] = $this->language->get('digest');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

		if (isset($this->error['warning_mid'])) {
			$data['warning_mid'] = $this->error['warning_mid'];
		} else {
			$data['warning_mid'] = '';
		}

		if (isset($this->error['warning_digest'])) {
			$data['warning_digest'] = $this->error['warning_digest'];
		} else {
			$data['warning_digest'] = '';
		}

		if (isset($this->error['warning_minimum_installments_cost'])) {
			$data['warning_minimum_installments_cost'] = $this->error['warning_minimum_installments_cost'];
		} else {
			$data['warning_minimum_installments_cost'] = '';
		}

		if (isset($this->error['warning_installments'])) {
			$data['warning_installments'] = $this->error['warning_installments'];
		} else {
			$data['warning_installments'] = '';
		}

		if (isset($this->error['warning_empty_installments'])) {
			$data['warning_empty_installments'] = $this->error['warning_empty_installments'];
		} else {
			$data['warning_empty_installments'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/cardlink', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('payment/cardlink', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->post['cardlink_mid'])) {
			$data['cardlink_mid'] = $this->request->post['cardlink_mid'];
		} else {
			$data['cardlink_mid'] = $this->config->get('cardlink_mid');
		}

		if (isset($this->request->post['cardlink_confirmUrl'])) {
			$data['cardlink_confirmUrl'] = $this->request->post['cardlink_confirmUrl'];
		} else {
			$data['cardlink_confirmUrl'] = $this->config->get('cardlink_confirmUrl');
		}

		if (isset($this->request->post['cardlink_cancelUrl'])) {
			$data['cardlink_cancelUrl'] = $this->request->post['cardlink_cancelUrl'];
		} else {
			$data['cardlink_cancelUrl'] = $this->config->get('cardlink_cancelUrl');
		}

		if (isset($this->request->post['cardlink_geo_zone_id'])) {
			$data['cardlink_geo_zone_id'] = $this->request->post['cardlink_geo_zone_id'];
		} else {
			$data['cardlink_geo_zone_id'] = $this->config->get('cardlink_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['cardlink_status'])) {
			$data['cardlink_status'] = $this->request->post['cardlink_status'];
		} else {
			$data['cardlink_status'] = $this->config->get('cardlink_status');
		}

		if (isset($this->request->post['cardlink_sort_order'])) {
			$data['cardlink_sort_order'] = $this->request->post['cardlink_sort_order'];
		} else {
			$data['cardlink_sort_order'] = $this->config->get('cardlink_sort_order');
		}
		
		if (isset($this->request->post['cardlink_installments'])) {
			$data['cardlink_installments'] = $this->request->post['cardlink_installments'];
		} else {
			$data['cardlink_installments'] = $this->config->get('cardlink_installments');
		}

		if (isset($this->request->post['cardlink_minimum_installments_cost'])) {
			$data['cardlink_minimum_installments_cost'] = $this->request->post['cardlink_minimum_installments_cost'];
		} else {
			$data['cardlink_minimum_installments_cost'] = $this->config->get('cardlink_minimum_installments_cost');
		}

		if (isset($this->request->post['cardlink_sandbox'])) {
			$data['cardlink_sandbox'] = $this->request->post['cardlink_sandbox'];
		} else {
			$data['cardlink_sandbox'] = $this->config->get('cardlink_sandbox');
		}

		if (isset($this->request->post['cardlink_bank'])) {
			$data['cardlink_bank'] = $this->request->post['cardlink_bank'];
		} else {
			$data['cardlink_bank'] = $this->config->get('cardlink_bank');
		}

		if (isset($this->request->post['cardlink_digest'])) {
			$data['cardlink_digest'] = $this->request->post['cardlink_digest'];
		} else {
			$data['cardlink_digest'] = $this->config->get('cardlink_digest');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/cardlink', $data));
	}

	private function validate() {
		if (!$this->request->post['cardlink_mid']) {
			$this->error['warning_mid'] = $this->language->get('error_mid');
		}

		if (!$this->request->post['cardlink_digest']) {
			$this->error['warning_digest'] = $this->language->get('error_digest');
		}

		if (!$this->request->post['cardlink_minimum_installments_cost']) {
			$this->error['warning_minimum_installments_cost'] = $this->language->get('error_minimum_installments_cost');
		}

		if ($this->request->post['cardlink_installments'] == 1) {
			$this->error['warning_installments'] = $this->language->get('error_installments');
		}

		if (!$this->request->post['cardlink_installments']) {
			$this->error['warning_empty_installments'] = $this->language->get('error_empty_installments');
		}

		return !$this->error;
	}
}