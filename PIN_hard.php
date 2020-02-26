<?php
    verify();
    function verify($width = 100 , $height = 40 , $num = 5 , $type = 3 ){
        session_start();
        //1 创建画布
        $image = imagecreatetruecolor($width , $height);
        
        //2 创建颜色  //因为后边总是用，所以写了两个函数，分别是lightColor(浅颜色)、deepColor(深颜色)
        
        
        //3 创建字符 //这里是自己选择的类型，1 就是纯数字，2 就是纯小字母， 3 就是数字大小写字母的混合
        switch($type){
            case 1:
                //定义字符串
                $str = "0123456789";
                //打乱字符串
                $strNew = str_shuffle($str);
                //截取$num个
                $string = substr($strNew , 0 , $num);
                break;
            case 2:
                //定义字符
                $arr = range('a' , 'z');
                //打乱字符串数组
                shuffle($arr);
                //截取
                $tmp = array_slice($arr , 0 , $num);
                //连成字符串
                $string = join('' , $tmp);
                break;
            case 3:
                $str = "23456789abcdefghjklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
                $string = substr(str_shuffle($str) , 0 , $num);
                break;
        }

        //4 往画布上写入字符
        $_SESSION['pic'] =strtoupper($string);//将随机数保存到session

        //给背景填充浅颜色 //背景颜色太深的话验证码就看不清了
        imagefilledrectangle($image , 0 , 0 , $width , $height , lightColor($image));
        
        //5 往画布上写入字符
        for($i = 0; $i<$num; $i++) {  //因为我们设定的是输出5 个字符，所以$i是小于的$num
            //floor是取整，$width / $num 把宽度分了$num块地，*$i是一个字符占一块地，以免全都堆在一块看不出来
            $x = floor($width / $num) * $i;
            $y = mt_rand(10 , $height - 20);
            imagechar ($image , 5 , $x , $y , $string[$i] , deepColor($image));
        }
        
        //6 画干扰线、点
        //干扰线
        for($i = 0; $i<$num; $i++) {
            imagearc ($image , mt_rand(10 , $width) , mt_rand(10 , $height) , mt_rand(10 , $width) , mt_rand(10 , $height) , mt_rand(0 , 10) , mt_rand(0 , 270) , deepColor($image));
            
        }
        //干扰点
        for( $i = 0; $i<50; $i++) {
            imagesetpixel($image , mt_rand(0 , $width) , mt_rand(0 , $height) , deepColor($image));
        }
        ob_clean();//擦除缓冲区  
        //7 告诉浏览器输出格式:png
        header("Content-type: image/png");
        
        //8 输出图片
        imagepng($image);
        
        //9 销毁
        imagedestroy($image);

        return $string;
    }


    //设置深浅颜色
    function lightColor ($image) {
        return imagecolorallocate($image , mt_rand(120 , 255) , mt_rand(120 , 255) , mt_rand(120 , 255)); 
    }

    function deepColor ($image) {
        return imagecolorallocate($image , mt_rand(0 , 120) , mt_rand(0 , 120) , mt_rand(0 , 120)); 
    }    
    ?>