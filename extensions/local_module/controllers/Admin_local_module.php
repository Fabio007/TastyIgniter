<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Admin_local_module extends Admin_Controller {

	public function index($data = array()) {
        $this->user->restrict('Module.LocalModule');

        if (!empty($data)) {
            $data['title'] = (isset($data['title'])) ? $data['title'] : 'Local Module';

            $this->template->setTitle('Module: ' . $data['title']);
            $this->template->setHeading('Module: ' . $data['title']);
            $this->template->setButton($this->lang->line('button_save'), array('class' => 'btn btn-primary', 'onclick' => '$(\'#edit-form\').submit();'));
            $this->template->setButton($this->lang->line('button_save_close'), array('class' => 'btn btn-default', 'onclick' => 'saveClose();'));
            $this->template->setBackButton('btn btn-back', site_url('extensions'));

            if ($this->input->post() AND $this->_updateModule() === TRUE) {
                if ($this->input->post('save_close') === '1') {
                    redirect('extensions');
                }

                redirect('extensions/edit?action=edit&name=local_module');
            }

            return $this->load->view('local_module/admin_local_module', $data, TRUE);
        }
	}

	private function _updateModule() {
    	if ($this->validateForm() === TRUE) {
			$update = array();

			$update['type'] 			= 'module';
			$update['name'] 			= $this->input->get('name');
			$update['title'] 			= $this->input->post('title');
			$update['extension_id'] 	= (int) $this->input->get('id');

			if ($this->Extensions_model->updateExtension($update, '1')) {
				$this->alert->set('success', 'Local Module updated successfully.', 'local_module');
			} else {
				$this->alert->set('warning', 'An error occurred, nothing updated.', 'local_module');
			}

			return TRUE;
		}
	}

 	private function validateForm() {
		$this->form_validation->set_rules('title', 'Title', 'xss_clean|trim|required|min_length[2]|max_length[128]');

		if ($this->form_validation->run() === TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file local_module.php */
/* Location: ./extensions/local_module/controllers/local_module.php */