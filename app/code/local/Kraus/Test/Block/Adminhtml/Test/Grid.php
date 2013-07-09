<?php
 
class Kraus_Test_Block_Adminhtml_Test_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
		// Set some defaults for our grid
        $this->setId('kraus_test');
        // This is the primary key of the database
        $this->setDefaultSort('id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
 
     
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
       
        $collection = Mage::getModel('test/test')->getCollection();
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );
         
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );
         $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'email'
            )
        );
         $this->addColumn('telephone',
            array(
                'header'=> $this->__('Telephone'),
                'index' => 'telephone'
            )
        );
         $this->addColumn('address',
            array(
                'header'=> $this->__('Address'),
                'index' => 'address'
            )
        );
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}