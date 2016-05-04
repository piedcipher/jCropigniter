class User extends CI_Controller {
 
    public function upload() {
        $this->load->view('upload');
    }
 
    public function crop() {
        $this->form_validation->set_rules('path', 'Display Image', 'required|trim');
 
        if($this->form_validation->run() == FALSE) {
            $this->upload();
        } else {
            $display_image = $this->input->post('image');
            $display_text = $this->input->post('path');
           
            $x = $this->input->post('x');
            $y = $this->input->post('y');
            $x2 = $this->input->post('x2');
            $y2 = $this->input->post('y2');
 
            $w = $this->input->post('w');
            $h = $this->input->post('h');
 
            $this->load->library('upload');
           
            # Upload Path, you need to create "upload" folder in your root directory of your project.
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
           
            # Initialize you Configuration.
            $this->upload->initialize($config);
 
 
            if(!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                redirect(site_url('user/upload\/'), 'refresh');
            } else {
                // var_dump($_POST);
               
                if($x == "" || ($w == 0 && $h == 0)) {
                    # If user didn't crop image.
                    $uploaded_image = array('upload_data' => $this->upload->data());
                    // var_dump($uploaded_image);
                } else {
                    # If user cropped image.
                    $uploaded_image = array('upload_data' => $this->upload->data());
                    $file_path = $uploaded_image['upload_data']['file_path'];
                    $file_name = $uploaded_image['upload_data']['file_name'];
                    $full_path = $uploaded_image['upload_data']['full_path'];
 
                    $quality = 90;
 
                    $targ_w = $w;
                    $targ_h = $h;
                   
                    # Returns an image identifier representing a black image of width $targ_w and height $targ_h.
                    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
 
                    # Check extesnion of image and call appropriate method.
                    $what = getimagesize('./uploads/images/' . $file_name);
                    switch(strtolower($what['mime'])) {
 
                        # imagecopyresampled function take Rectangular area from $img_r of width $w and height $h at position ($x, $y) and place it in a rectangular area of $dst_r of width $targ_w and height $targ_h at position (0 ,0).
 
                        case 'image/png':
                            $img_r = imagecreatefrompng('./uploads/images/' . $file_name);
 
                            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
                           
                            # Genetate a png
                            imagepng($dst_r, $full_path, $quality);
                            break;
                       
                        case 'image/jpeg':
                            $img_r = imagecreatefromjpeg('./uploads/images/' . $file_name);
 
                            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
                           
                            # Generates a jpeg.
                            imagejpeg($dst_r, $full_path, $quality);
                            break;
                       
                        case 'image/gif':
                            $img_r = imagecreatefromgif('./uploads/images/' . $file_name);
 
                            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
                           
                            # Generates a gif.
                            imagegif($dst_r, $full_path, $quality);
                            break;
 
                        default: die();
                    }
                    // var_dump($uploaded_image);
                }
            }
        }
    }
}