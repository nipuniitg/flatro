<?php
/**
 * Created by PhpStorm.
 * User: sahruj
 * Date: 5/20/14
 * Time: 3:17 PM
 */
require('includes/configure.php');
$qno = intval($_GET['qno']);

if($qno == 1)
{
    $sortby = intval($_GET['sortby']);
    $subocc_id = intval($_GET['subocc_id']);
    $occ = $_GET['occ'];
    $limitpage = intval($_GET['limit']);
    $start_img = intval($_GET['startnum']);
    $minprice = floatval($_GET['minprice']);
    $maxprice = floatval($_GET['maxprice']);
    $brandstr = $_GET['brands'];

//    if($brandstr != "") {
//        $brand_arr = explode(",",$brandstr);
//    for($i=0; $i<count($brand_arr);$i++)
//    {
//        echo $brand_arr[$i];
//        echo " , ";
//    }
//        echo count($brand_arr);
//
//    }
//    else {
//        $brand_arr = array();
//    }
//
//    $brandstr = join('","',$brand_arr);

//echo "get lost ";
 $query_str = "SELECT * FROM tagdata_shristi where id IN (SELECT DISTINCT id FROM {$occ} WHERE sub_occasion=$subocc_id) AND price>=$minprice AND price<=$maxprice ";
if($brandstr != "")
{
    $query_str = $query_str . " AND productBrand IN (\"$brandstr\") ";
}
switch($sortby) {
    case 1 : //sort by price low to high
        $query_str = $query_str . " ORDER BY price ASC limit $start_img,$limitpage";
        break;
    case 2 : // sort by price high to low
        $query_str = $query_str . " ORDER BY price DESC limit $start_img,$limitpage";
        break;
   /* case 3 :    //sort by rating highest
        break;
    case 4 :    //sort by rating lowest
        break;
    case 5 :    //sort by recent
        break;  */
    default :   // by default sort by price low to high
        $query_str = $query_str . " ORDER BY price ASC limit $start_img,$limitpage";
        break;

}
    //echo $query_str;
    $result = mysqli_query($con,$query_str);
    if(!$result){
        echo 'Error	2';
    }
    else{
        $count = 1;
        while($row = $result->fetch_object())
        {
            if($count % 3 == 1)
            {
                echo "<div class=\"row box-product\">";
            }
            echo "<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-12\">
              <div class=\"product-block\">
                  <div class=\"image\">
                      <div class=\"product-label product-sale\"><span>New</span></div>
                      <a class=\"img\" href=\"product.php\"><img alt=\"product info\" src=\"$row->imageurl\" title=\"product title\"></a> </div>
                  <div class=\"product-meta\">
                      <div class=\"name\"><a href=\"product.php\">$row->Product</a></div>
                      <div class=\"big-price\"> <span class=\"price-new\"><span class=\"sym\">&#8377;</span>$row->price</span> <span class=\"price-old\"><span class=\"sym\">&#8377</span>$row->mrp</span> </div>
                      <div class=\"big-btns\"> <a class=\"btn btn-default btn-view pull-left\" href=\"#\">View</a> <a class=\"btn btn-default btn-addtocart pull-right\" href=\"#\">Add to
                          Cart</a> </div>
                      <div class=\"small-price\"> <span class=\"price-new\"><span class=\"sym\">&#8377;</span>$row->price</span> <span class=\"price-old\"><span class=\"sym\">&#8377;</span>$row->mrp</span> </div>
                      <div class=\"rating\"> <i class=\"fa fa-star\"></i> <i class=\"fa fa-star\"></i> <i class=\"fa fa-star\"></i> <i class=\"fa fa-star-half-o\"></i> <i class=\"fa fa-star-o\"></i> </div>
                      <div class=\"small-btns\">
                          <button class=\"btn btn-default btn-compare pull-left\" data-toggle=\"tooltip\" title=\"Add to Compare\"> <i class=\"fa fa-retweet fa-fw\"></i> </button>
                          <button class=\"btn btn-default btn-wishlist pull-left\" data-toggle=\"tooltip\" title=\"Add to Wishlist\"> <i class=\"fa fa-heart fa-fw\"></i> </button>
                          <button class=\"btn btn-default btn-addtocart pull-left\" data-toggle=\"tooltip\" title=\"Add to Cart\"> <i class=\"fa fa-shopping-cart fa-fw\"></i> </button>
                      </div>
                  </div>
                  <div class=\"meta-back\"></div>
              </div>
          </div>";

            if($count % 3 == 0)
            {
                echo "</div>";
                echo "<div class=\"clearfix f-space30\"></div>";
            }
            $count = $count + 1;

        }
        if($count != 1 and $count % 3 != 0)
        {
            echo "</div>";

        }
        $checkmore = 0;
        if($count == 1){
            echo "No More Images";
            $checkmore = 0;
        }
        else
        {
            $checkmore = 1;
               // $checkmore = 0;
        }
        //echo "<input type=\"hidden\" id=\"moreprods\" value=\"$checkmore\" >";

    }

}


?>