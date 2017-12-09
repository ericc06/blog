<?php
require 'twigInit.php';
require_once("model/PostManager.php");

ob_start();

$postManager = new \EricCodron\Blog\Model\PostManager();
$total = $postManager->getPostsNumber();

$adjacents = 3;
$targetpage = "index.php?action=listPosts"; //your file name
$limit = 3; //how many items to show per page
if(isset($_GET['page']))
    $page = $_GET['page'];
else    
    $page = 1;

if($page){ 
$start = ($page - 1) * $limit; //first item to display on this page
}else{
$start = 0;
}

/* Setup page vars for display. */
if ($page == 0) $page = 1; //if no page var is given, default to 1.
$prev = $page - 1; //previous page is current page - 1
$next = $page + 1; //next page is current page + 1
$lastpage = ceil($total/$limit); //lastpage.
$lpm1 = $lastpage - 1; //last page minus 1

/*
$sql2 = "select * from table name where 1=1";
$sql2 .= " order by id desc limit $start ,$limit ";
$sql_query = mysql_query($sql2); 
$curnm = mysql_num_rows($sql_query);
*/


$postsRange = $postManager->getPostsRange($start ,$limit);
$counter = count($postsRange);

/* CREATE THE PAGINATION */

$pagination = "";
if($lastpage > 1)
{ 
$pagination .= "<div class='pagination-div text-center'> <ul class='pagination'>";
if ($page > $counter+1) {
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$prev\">prev</a></li>"; 
}

if ($lastpage < 7 + ($adjacents * 2)) 
{ 
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<li class='page-item'><a class='page-link' href='#' class='active'>$counter</a></li>";
else
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$counter\">$counter</a></li>"; 
}
}
elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
{
//close to beginning; only hide later pages
if($page < 1 + ($adjacents * 2)) 
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
$pagination.= "<li class='page-item'><a class='page-link' href='#' class='active'>$counter</a></li>";
else
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$counter\">$counter</a></li>"; 
}
$pagination.= "<li class='page-item'>...</li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$lastpage\">$lastpage</a></li>"; 
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=1\">1</a></li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=2\">2</a></li>";
$pagination.= "<li class='page-item'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
$pagination.= "<li class='page-item'><a class='page-link' href='#' class='active'>$counter</a></li>";
else
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$counter\">$counter</a></li>"; 
}
$pagination.= "<li class='page-item'>...</li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$lastpage\">$lastpage</a></li>"; 
}
//close to end; only hide early pages
else
{
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=1\">1</a></li>";
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=2\">2</a></li>";
$pagination.= "<li class='page-item'>...</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
$counter++)
{
if ($counter == $page)
$pagination.= "<li class='page-item'><a class='page-link' href='#' class='active'>$counter</a></li>";
else
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$counter\">$counter</a></li>"; 
}
}
}

//next button
if ($page < $counter - 1) 
$pagination.= "<li class='page-item'><a class='page-link' href=\"$targetpage&page=$next\">next</a></li>";
else
$pagination.= "";
$pagination.= "</ul></div>\n"; 
}

$template = $twig->loadTemplate('listPostsView.twig');
echo $template->render(array(
    'posts' => $postsRange,
    'pagination' => $pagination
));

$content = ob_get_clean();

require('template.php');
