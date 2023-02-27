<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

// ТЕЛО
    $sum = 0;
    foreach($example_persons_array as $k){
        // та самая строка ФИО, которая передается всем необходимым функциям по условию задания
        $stringName = $example_persons_array[$sum]["fullname"];
        getPartsFromFullName($stringName);
        echo '<br>' ;
        echo 'Я разделил ФИО на три строки: <br>' ;
        // getSurname($stringName);
        $surname = getSurname($stringName);
        echo '<br>' ;
        // getName($stringName);
        $name = getname($stringName);
        echo '<br>' ;
        // getPartonomyc($stringName);
        $partonomyc = getPartonomyc($stringName);
        echo '<br>' ;
        echo '<br>' ;
        getFullnameFromParts($surname,$name,$partonomyc);
        $gensum = getGenderFromName($stringName);
        echo '<br>' ;
        echo '<br>' ;
        getShortName($stringName);
        echo '<br>' ;
        echo '<br>' ;
        // getGenderDescription($example_persons_array, $stringName);
        // echo $example_persons_array[$sum]["fullname"];
        $sum++;
        if(!empty($k['fullname']) && is_array($k['fullname'])){ 
            $sum += ($k['fullname']); 
        }
    }
    echo $sum;

// разделение ФИО в массив из 3 элементов
function getPartsFromFullName($stringName) {
    $arrayfamily = ['surname', 'name', 'patronomyc'];
    $stringPartsName = explode(' ', $stringName);
    $arr3 = (array_combine($arrayfamily, $stringPartsName));
    echo '<br>';
    // print_r($arr3); 
    return $arr3;
}

// функция получения строки Фамилии
function getSurname($stringName){
    $stringPartsName = explode(' ', $stringName);
    $surname = $stringPartsName[0];
    echo $surname; 
    return $surname;
}
// функция получения строки Имени
function getName($stringName){
    $stringPartsName = explode(' ', $stringName);
    $name = $stringPartsName[1];
    echo $name; 
    return $name;
}
// функция получения строки Отчества
function getPartonomyc($stringName){
    $stringPartsName = explode(' ', $stringName);
    $partonomyc = $stringPartsName[2];
    echo $partonomyc; 
    return $partonomyc;
}

// склеивание ФИО из 3 строк
function getFullnameFromParts($surname,$name,$partonomyc){
    $fullname = $surname . ' ' . $name . ' ' . $partonomyc;
    echo 'Я склеил ФИО из 3-х строк: ';
    echo $fullname;
    return $fullname;
}

// функция сокращения ФИО
function getShortName($stringName){
    $arr = getPartsFromFullName($stringName);
    $surname1 = $arr["surname"];
    $name1 = $arr["name"];
    $surname1 = mb_substr($surname1, 0, 1);
    $namesurname = $name1 . ' ' . $surname1 . '.';
    // $namesurname = mb_convert_encoding($namesurname, "windows-1251");
    echo $namesurname;
    return $namesurname;
}

// определение гендера
function getGenderFromName($stringName){
    $gensum = 0;
    $arr = getPartsFromFullName($stringName);
    $surname1 = $arr["surname"];
    $name1 = $arr["name"];
    $partonomyc1 = $arr["partonomyc"];
    if (mb_substr($surname1,-2) == 'ва'){
        $gensum--;
    }elseif(mb_substr($surname1,-1) == 'в'){
        $gensum++;
    }
        if (mb_substr($name1,-1) == 'а'){
            $gensum--;
        }elseif(mb_substr($name1,-1) == 'й'|| mb_substr($name1,-1) == 'н'){
            $gensum++;
        }
            if (mb_substr($partonomyc1, -3) == 'вна'){
                $gensum--;
            } elseif(mb_substr($partonomyc1, -2) == 'ич'){
                $gensum++;
            } 
    if($gensum > 0){
        $gensum = 1 . ' ' . 'мужской';
    }elseif($gensum < 0){
        $gensum = -1 . ' ' . 'женский';
    }else{
        $gensum = 0 . ' ' . 'не удалось определить';
    }
    echo $gensum;
    return $gensum;
}

// функция определения гендерного состава
function getGenderDescription($example_persons_array, $stringName){
    $example_persons_array["gender"] = getGenderFromName($stringName);
    print_r($example_persons_array);
    echo '<br>';
    return $example_persons_array;
}