<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Panel Controller
 *
 *
 * @method \App\Model\Entity\Panel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PanelController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('TopSliderHomepage');
        $this->loadComponent('Flash');
    }

    public function index()
    {

    }

    public function login()
    {

    }
    public function slider()
    {
        $top_slider_homepage = $this->loadModel('TopSliderHomepage');
        $top_slider_homepage = $top_slider_homepage->find();

        $this->set("top_slider_homepage", $top_slider_homepage);
    }
    public function upload()
    {
        $imageSentFromForm = $this->request->getData(['image_path']);
        $titleFromForm = $this->request->getData('title');
        $descriptionFromForm = $this->request->getData('description');
        $isVisibleFromForm = $this->request->getData('is_visible');
        if(empty($isVisibleFromForm)) {
            $isVisibleFromForm = '0';
        }
        $uploadPath = 'assets/top_slider_homepage/';
        if(!empty($imageSentFromForm) && !empty($titleFromForm) && !empty($descriptionFromForm)) {
            $imageName = $imageSentFromForm['name'];
            $imageName = str_replace(" ", "_", $imageName);
            $imageName = strtolower($imageName);

            $pathToUploadedImage = $uploadPath.$imageName;
            if (move_uploaded_file($imageSentFromForm['tmp_name'],$pathToUploadedImage))
            {
                $saveInDb = $this->TopSliderHomepage->newEntity();
                $saveInDb->title = $titleFromForm;
                $saveInDb->description = $descriptionFromForm;
                $saveInDb->url = 'top_slider_homepage/' . $imageName;
                $saveInDb->is_visible = $isVisibleFromForm;
                if($this->TopSliderHomepage->save($saveInDb))
                {
                    $this->Flash->success(__('Zdjęcie zostało poprawnie załadowane!'));
                } else {
                    $this->Flash->error(__('Nie udało się wgrac zdjęcia!'));
                }


                $this->redirect('/panel/slider');
            }

        }
    }

    public function editSlider($id = null)
    {
        $top_slider_homepage = $this->loadModel('TopSliderHomepage');
        $top_slider_homepage = $top_slider_homepage->findById($id)->first();

        $this->set("top_slider_homepage", $top_slider_homepage);
        $this->render("edit_slider");

    }

    public function updateSlider($id = null)
    {
        $top_slider_homepage_table = TableRegistry::getTableLocator()->get('TopSliderHomepage');
        $slider_element = $top_slider_homepage_table->get($id);

        $titleFromForm = $this->request->getData('title');
        $descriptionFromForm = $this->request->getData('description');
        $isVisibleFromForm = $this->request->getData('is_visible');

        $slider_element->title = $titleFromForm;
        $slider_element->description = $descriptionFromForm;
        $slider_element->is_visible = $isVisibleFromForm;

        $top_slider_homepage_table->save($slider_element);

        $this->redirect('/panel/edit_slider/'. $id);
    }

    public function removeSlider($id = null) {
        $top_slider_homepage_table = TableRegistry::getTableLocator()->get('TopSliderHomepage');
        $slider_element = $top_slider_homepage_table->get($id);
        $top_slider_homepage_table->delete($slider_element);

        unlink(WWW_ROOT . '/assets/'. $slider_element->url);

        $this->Flash->success(__('Zdjęcie zostało poprawnie usunięte!'));

        $this->redirect('/panel/slider/');
    }

    //favourites footer
    public function favouritesFooter() {
        $favourites_footer = $this->loadModel('FavouritesFooter');
        $favourites_footer = $favourites_footer->find();

        $this->set("favourites_footer", $favourites_footer);
    }

    public function favouritesUpload() {
        $this->loadModel('FavouritesFooter');

        $imageSentFromForm = $this->request->getData(['image_path']);
        $isVisibleFromForm = $this->request->getData('is_visible');
        if(empty($isVisibleFromForm)) {
            $isVisibleFromForm = '0';
        }
        $uploadPath = 'assets/favourites_footer/';
        if(!empty($imageSentFromForm)) {
            $imageName = $imageSentFromForm['name'];
            $imageName = str_replace(" ", "_", $imageName);
            $imageName = strtolower($imageName);

            $pathToUploadedImage = $uploadPath.$imageName;
            if (move_uploaded_file($imageSentFromForm['tmp_name'],$pathToUploadedImage))
            {
                $saveInDb = $this->FavouritesFooter->newEntity();
                $saveInDb->url = 'favourites_footer/' . $imageName;
                $saveInDb->is_visible = $isVisibleFromForm;
                if($this->FavouritesFooter->save($saveInDb))
                {
                    $this->Flash->success(__('Zdjęcie zostało poprawnie załadowane!'));
                } else {
                    $this->Flash->error(__('Nie udało się wgrac zdjęcia!'));
                }


                $this->redirect('/panel/favourites_footer');
            }

        }
    }


}
