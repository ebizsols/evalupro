<?php
$valuationLang = array();
$valuationLang['orderOrigination'] = 'Order Origination';
$valuationLang['moduleName'] = 'Valuation';
$valuationLang['dashboard'] = 'Valuation Dashboard';

//Left menu
$leftMenu = array();
$leftMenu['levelOneName'] = $valuationLang['moduleName'];
$leftMenu['settings'] = 'Settings';
$valuationLang['leftMenu'] = $leftMenu;

$menu = array();
$menu['title'] = 'Menu';
$menu['totalMenu'] = 'Total Menu';
$menu['createMenu'] = 'Create Menu';
$menu['editMenu'] = 'Edit Menu';
$menu['menuParent'] = 'Menu Parent';
$menu['validationName'] = 'Validation Name';
$menu['route'] = 'Route';
$valuationLang['menu'] = $menu;

$settings = array();
$settings['title'] = 'Settings';
$settings['country'] = 'Country';
$valuationLang['settings'] = $settings;

$governorate = array();
$governorate['title'] = 'Governorate';
$governorate['totalGovernorate'] = 'Total Governorate';
$governorate['createGovernorate'] = 'Create Governorate';
$governorate['editGovernorate'] = 'Edit Governorate';
$governorate['selectCountry'] = 'Select Country';
$valuationLang['governorate'] = $governorate;

$city = array();
$city['title'] = 'City';
$city['totalCity'] = 'Total City';
$city['createCity'] = 'Create City';
$city['editCity'] = 'Edit City';
$city['selectCountry'] = 'Select Country';
$city['selectGovernorate'] = 'Select Governorate';
$valuationLang['city'] = $city;

$block = array();
$block['title'] = 'Block';
$block['totalBlock'] = 'Total Block';
$block['createBlock'] = 'Create Block';
$block['editBlock'] = 'Edit Block';
$block['selectCountry'] = 'Select Country';
$block['selectGovernorate'] = 'Select Governorate';
$block['selectCity'] = 'Select City';
$valuationLang['block'] = $block;
$valuationLang['intendedUser']['title'] = 'Title';
$valuationLang['intendedUser']['homeTitle'] = 'Intended User';
$valuationLang['intendedUser']['totalBlock'] = 'Total User';
$valuationLang['intendedUser']['createBlock'] = 'Create User';


$property = array();
$property['title'] = 'Properties';
$property['total'] = 'Total Properties';
$property['selectCity'] = 'Select City';
$property['selectTypes'] = 'Select Type';
$property['selectClassification'] = 'Select Classification';
$property['selectCategorization'] = 'Select Categorization';
$property['createProperty'] = 'Create Property';
$property['editProperty'] = 'Edit Property';
$property['detailProperty'] = 'Detail';
$property['propertyBackBtn'] = 'Back';
$property['sr'] = 'Sr';
$property['propertyType'] = 'Type';
$property['propertyCity'] = 'City';
$valuationLang['property'] = $property;

$type = array();
$type['title'] = 'Property Type';
$type['propertyList'] = 'List of properties';
$type['total'] = 'Total Property Type';
$type['createPropertyType'] = 'Create Property Type';
$type['editPropertyType'] = 'Edit Property Type';
$valuationLang['property']['type'] = $type;

$classification = array();
$classification['title'] = 'Property Classification';
$classification['total'] = 'Total Property Classification';
$classification['createPropertyClassification'] = 'Create Property Classification';
$classification['editPropertyClassification'] = 'Edit Property Classification';
$valuationLang['property']['classification'] = $classification;

$categorization = array();
$categorization['title'] = 'Property Categorization';
$categorization['total'] = 'Total Property Categorization';
$categorization['createPropertyCategorization'] = 'Create Property Categorization';
$categorization['editPropertyCategorization'] = 'Edit Property Categorization';
$valuationLang['property']['categorization'] = $categorization;

$class = array();
$class['title'] = 'Property Class';
$class['total'] = 'Total Property Class';
$class['createPropertyClass'] = 'Create Property Class';
$class['editPropertyClass'] = 'Edit Property Class';
$valuationLang['property']['class'] = $class;

$propertyImges=array();
$propertyImges['image']='Property Image';
$valuationLang['property']['media']=$propertyImges;

$measurementUnit=array();
$measurementUnit['measurementTitle']='Measurement Unit';
$measurementUnit['Title']='Measurement Unit Setting';
$valuationLang['measurement']=$measurementUnit;

$generalSettings=array();
$generalSettings['Title']="General Setting";
$generalSettings['createFeature']="Create Setting";
$generalSettings['totalFeture']="Total Settings";
$generalSettings['name']="Setting Name";
$generalSettings['category']="Category";

$valuationLang['generalSetting']=$generalSettings;

$propertyFeatures=array();
$propertyFeatures['Title']="Property Type Feature Setting";
$propertyFeatures['createFeature']="Create Feature";
$propertyFeatures['totalFeture']="Total Feature";
$propertyFeatures['name']="Feature Name";
$propertyFeatures['category']="Category";

$valuationLang['propertyFeature']=$propertyFeatures;

$valuationMethod=array();
$valuationMethod['Title']="Valuation Method Setting";
$valuationMethod['createFeature']="Create Method";
$valuationMethod['totalFeture']="Total Methods";
$valuationMethod['name']="Method Name";
$valuationMethod['category']="Approach";

$valuationLang['valuationMethod']=$valuationMethod;

$feactureCategory=array();
$feactureCategory['Title']="Property Feature Category";
$feactureCategory['createCategory']="New Category";
$feactureCategory['categoryName']="Category Name";
$feactureCategory['categoryCount']="Total Category";

$valuationApproach=array();
$valuationApproach['Title']="Valuation Approach";
$valuationApproach['createCategory']="New Approach";
$valuationApproach['categoryName']="Approach Name";
$valuationApproach['categoryCount']="Total Approaches";

$valuationLang['valuationApproach']=$valuationApproach;

$weightageCategory = array();
$weightageCategory['title'] = 'Weightage Category';
$weightageCategory['totalWeightageCategory'] = 'Total Weightage Category';
$weightageCategory['createWeightageCategory'] = 'Create Weightage Category';
$weightageCategory['editWeightageCategory'] = 'Edit Weightage Category';
$valuationLang['weightageCategory'] = $weightageCategory;

$propertyWeightage = array();
$propertyWeightage['title'] = 'Weightage';
$propertyWeightage['totalWeightage'] = 'Total Weightage';
$propertyWeightage['createWeightage'] = 'Create Weightage';
$propertyWeightage['editWeightage'] = 'Edit Weightage';
$propertyWeightage['category'] = 'Weightage Category';
$valuationLang['propertyWeightage'] = $propertyWeightage;

return $valuationLang;