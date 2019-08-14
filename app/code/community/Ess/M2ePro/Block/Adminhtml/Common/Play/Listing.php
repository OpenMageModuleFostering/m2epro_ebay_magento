<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Common_Play_Listing extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    // ####################################

    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('playListing');
        $this->_blockGroup = 'M2ePro';
        $this->_controller = 'adminhtml_common_play_listing';
        //------------------------------

        // Set header text
        //------------------------------
        $this->_headerText = '';
        //------------------------------

        // Set buttons actions
        //------------------------------
        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('delete');
        $this->removeButton('add');
        $this->removeButton('save');
        $this->removeButton('edit');
        //------------------------------

        //------------------------------

        $backUrl = Mage::helper('M2ePro')->makeBackUrlParam(
            '*/adminhtml_common_listing/index',
            array(
                'tab' => Ess_M2ePro_Block_Adminhtml_Common_Component_Abstract::TAB_ID_PLAY
            )
        );

        //------------------------------
        $url = $this->getUrl(
            '*/adminhtml_common_log/listing',
            array(
                'channel' => Ess_M2ePro_Block_Adminhtml_Common_Log_Tabs::TAB_ID_PLAY
            )
        );
        $this->_addButton('view_log', array(
            'label'     => Mage::helper('M2ePro')->__('View Log'),
            'onclick'   => 'window.open(\''.$url.'\')',
            'class'     => 'button_link'
        ));
        //------------------------------

        //------------------------------
        $url = $this->getUrl('*/adminhtml_common_play_listing/search', array('back' => $backUrl));
        $this->_addButton('search_play_products', array(
            'label'     => Mage::helper('M2ePro')->__('Search'),
            'onclick'   => 'setLocation(\''.$url.'\')',
            'class'     => 'button_link search'
        ));
        //------------------------------

        //------------------------------
        $url = $this->getUrl('*/adminhtml_common_listing_create/index', array(
            'step' => '1',
            'clear'=>'yes',
            'component' => Ess_M2ePro_Helper_Component_Play::NICK
        ));
        $this->_addButton('add', array(
            'label'     => Mage::helper('M2ePro')->__('Add Listing'),
            'onclick'   => 'setLocation(\'' .$url.'\')',
            'class'     => 'add'
        ));
        //------------------------------
    }

    // ####################################

    public function getTemplatesButtonJavascript()
    {
        $data = array(
            'target_css_class' => 'play-templates-drop-down',
            'items'            => $this->getTemplatesButtonDropDownItems()
        );
        $dropDownBlock = $this->getLayout()->createBlock('M2ePro/adminhtml_widget_button_dropDown');
        $dropDownBlock->setData($data);

        return $dropDownBlock->toHtml();
    }

    protected function getTemplatesButtonDropDownItems()
    {
        $items = array();

        $filter = base64_encode('component_mode=' . Ess_M2ePro_Helper_Component_Play::NICK);

        //------------------------------
        $url = $this->getUrl(
            '*/adminhtml_common_template_sellingFormat/index',
            array(
                'filter' => $filter
            )
        );
        $items[] = array(
            'url' => $url,
            'label' => Mage::helper('M2ePro')->__('Selling Format Policies'),
            'target' => '_blank'
        );
        //------------------------------

        //------------------------------
        $url = $this->getUrl(
            '*/adminhtml_common_template_synchronization/index',
            array(
                'filter' => $filter
            )
        );
        $items[] = array(
            'url' => $url,
            'label' => Mage::helper('M2ePro')->__('Synchronization Policies'),
            'target' => '_blank'
        );
        //------------------------------

        return $items;
    }

    // ####################################
}