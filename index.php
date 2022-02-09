<?php

//本地网站的跳转链接请用 xxx.com/xxx.php?mn=1234 ，http://xxx.com/xxx.php?mn=1234 或 http://www.xxx.com/xxx.php?mn=1234，具体用哪个链接请根据自己的网站实际测试最终的跳转地址使用
//设置
$magic_number = 1234; // 你可以选择任一一个数字，除了零
$banner = "";
$offer = "";
$web = "";


//实现步骤
//1.(获取offer传递参数，如果没有设置默认值5678)
//2.(获取web传递参数，如果没有设置默认值https://s.click.aliexpress.com/e/_9iSCfP)
//3.（$banner链接来自$web 和 offer的组合的值）
if($_GET['offer']!=""){
    $offer = $_GET['offer'];
}
if($_POST['offer']!=""){
    $offer = $_POST['offer'];
}
if($offer == ""){
    $offer = "1234"; //(获取offer传递参数，如果没有设置默认值5678)
}

if($_POST['web']!=""){
    $web =$_POST['web'];
}
    
if($_GET['web']!=""){
    $web =$_GET['web'];
}


if($web == ""){
$banner ='https://offer.alibaba.com/cps/p9tr5cm2?bm=cps&src=saf&tp1=1001';  
}else {
$banner ='https://offer.alibaba.com/cps/710mqfkh?bm=cps&src=saf'.'&url='.urlencode($web);
}
$ip = $_SERVER["REMOTE_ADDR"];
$file = fopen('log.txt','a+');
fwrite($file,'tp:'.$ismobile." ".'IP:'.$ip." ".'offer:'.$offer." ".'web:'.$web." ".$_SERVER['HTTP_USER_AGENT']." ".date("Y/m/d h:i:sa")."\r\n");//（记录传递参数保存在txt文件中）
fclose($file);

$red_method =1; // 0 = JS Form, 1 = JS, 2 = Meta Refresh

$form_method =1;  // 0 = POST, 1 = GET


//不要修改以下的PHP代码，除非你知道应该怎么修改

if (isset($_GET['mn']) && $_GET['mn']==$magic_number){

        echo '<html><head></head><body><form action="https://www.wzyubing.com" method="post" id="form1">

<input type="hidden"  name="mn" value="' . $magic_number . '" />
<input type="hidden"  name="web" value="' . $web . '" />
<input type="hidden"  name="offer" value="' . $offer . '" />

<script language="JavaScript">
    document.getElementById(\'form1\').submit();</script></body></html>';
        return true;
        exit();
}

if ($_POST['mn']==$magic_number){

        if($red_method==0) {

            if($form_method==0)
                $formmethod = "POST";
            else
                $formmethod = "GET";

            echo '<html><head></head><body><form action="' . $banner .  '" method="' . $formmethod . '" id="form1"></form>
<script language="JavaScript">

    document.getElementById(\'form1\').submit();

</script></body></html>';
        }

            else if($red_method == 1)

    echo     '<HEAD>
<SCRIPT language="JavaScript">
<!--
window.location="' . $banner . '";
//-->
</SCRIPT>


</HEAD>';

        else echo '<meta http-equiv="refresh" content=0;url=' . $banner  . '>';



    exit();
}

?>
