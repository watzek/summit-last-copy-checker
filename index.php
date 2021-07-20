<?php

$alliance=array("01ALLIANCE_COCC"=>"Central Oregon Community College",
"01ALLIANCE_CWU"=>"Central Washington University",
"01ALLIANCE_CHEMEK"=>"Chemeketa Community College",
"01ALLIANCE_CCC"=>"Clackamas Community College",
"01ALLIANCE_CC"=>"Clark College",
"01ALLIANCE_CONC"=>"Concordia University",
"01ALLIANCE_EOU"=>"Eastern Oregon University",
"01ALLIANCE_EWU"=>"Eastern Washington University",
"01ALLIANCE_GFU"=>"George Fox University",
"01ALLIANCE_LANECC"=>"Lane Community College",
"01ALLIANCE_LCC"=>"Lewis & Clark",
"01ALLIANCE_LINF"=>"Linfield College",
"01ALLIANCE_MHCC"=>"Mt Hood Community College",
"01ALLIANCE_OHSU"=>"Oregon Health & Science University",
"01ALLIANCE_OIT"=>"Oregon Institute of Technology",
"01ALLIANCE_OSU"=>"Oregon State University",
"01ALLIANCE_PU"=>"Pacific University",
"01ALLIANCE_PCC"=>"Portland Community College",
"01ALLIANCE_PSU"=>"Portland State University",
"01ALLIANCE_REED"=>"Reed College",
"01ALLIANCE_STMU"=>"Saint Martin's University",
"01ALLIANCE_SPU"=>"Seattle Pacific University",
"01ALLIANCE_SEAU"=>"Seattle University",
"01ALLIANCE_SOU"=>"Southern Oregon University",
"01ALLIANCE_EVSC"=>"The Evergreen State College",
"01ALLIANCE_UID"=>"University of Idaho",
"01ALLIANCE_UO"=>"University of Oregon",
"01ALLIANCE_UPORT"=>"University of Portland",
"01ALLIANCE_UPUGS"=>"University of Puget Sound",
"01ALLIANCE_UW"=>"University of Washington",
"01ALLIANCE_WALLA"=>"Walla Walla University",
"01ALLIANCE_WPC"=>"Warner Pacific College",
"01ALLIANCE_WSU"=>"Washington State University",
"01ALLIANCE_WOU"=>"Western Oregon University",
"01ALLIANCE_WWU"=>"Western Washington University",
"01ALLIANCE_WHITC"=>"Whitman College",
"01ALLIANCE_WW"=>"Whitworth University",
"01ALLIANCE_WU"=>"Willamette University");

$oclc=$_REQUEST["oclc"];

$url="https://na01.alma.exlibrisgroup.com/view/sru/01ALLIANCE_NETWORK?version=1.2&operation=searchRetrieve&query=alma.oclc_control_number_035_az=(OCoLC)$oclc";
/* make SRU call  */
$xml=simplexml_load_file($url);
$result="";
$x=0;

/* narrow to "record" element in XML  */
$r=$xml->records->record->recordData->record;
/* loop through datafields */
foreach ($r->datafield as $field){
  /* find datafields with tag 852   */
  if($field->attributes()->tag=="852"){
    /* get and print Alliance Member code*/
    $loc=$field->subfield[0];
    $library=$alliance["$loc"];
    $result.=$library.", ";
    $x++;
  }

}
if($x>0){
  $result=rtrim($result, ", ");
}
else{
  $result="No summit holdings";
}
echo $result;

?>
