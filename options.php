<?php
// Настройки Показания ИПУ
// Создание страницы настроек
function un_pokazaniya_ipu_settings_page() {
  add_options_page(
    'Настройки Показания ИПУ (шорткод [un_pokazaniya_ipu])', // Заголовок страницы настроек
    'Показания ИПУ', // Название пункта меню в боковой панели админки
    'manage_options', // Уровень доступа пользователя, который может просматривать страницу
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек
    'un_pokazaniya_ipu_settings_render' // Функция отображения содержимого страницы настроек
  );
}
add_action('admin_menu', 'un_pokazaniya_ipu_settings_page');

// Отображение содержимого страницы настроек
function un_pokazaniya_ipu_settings_render() {
  ?>
  <div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form id="op1" action="options.php" method="post">
      <?php settings_fields('un-pokazaniya-ipu-settings-group'); ?>
      <?php do_settings_sections('un-pokazaniya-ipu-settings'); ?> 
      <?php submit_button('Сохранить настройки','','submit1'); ?>     
    </form>
    <p class=""><h2>2. Вставьте в текстовое поле данные с показаниями в следующем порядке (каждый Лицевой счет с данными с новой строки):<br>
	Лицевой счет; Улица; Адрес; Счетчик1; Показание1; Счетчик2; Показание2; Счетчик3; Показание3;<br> 
	Пример:</h2><br>
	000000027008;Чехова;г. Белогорск, Чехова ул., 39А, кв. 68;Счетчик Чех39А68/к;3.000000;Счетчик Чех39А-68В;0.113000;;;<br>
    000000033823;Вольный;г. Белогорск, Вольный пер., 7, кв. 53;СчетВольн 7-53/в;0;СчетВольн 7-53/к;0;СчетВольн 7-53/с;0;<br>
    000000004247;Кирова;г. Белогорск, Кирова ул., 247/2, кв. 81;Счеткирова 247/2/81;4.294000;;;;;</p>
	<form id="op2" method="POST">
    <textarea name="word_list" rows="10" cols="50"><?php include( plugin_dir_path( __FILE__ ) . 'ipu/danniye.txt' ); ?></textarea>	
	<p>
	<input type="submit" name="submit2" id="submit2" class="button" value="Сохранить показания ИПУ">
	</p>
  </form>
  </div>
  <?php 

}

// Добавление опций на страницу настроек
function un_pokazaniya_ipu_settings() {
  register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-maxlength', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  ); 
  register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-datan', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  );  
  register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-datak', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  );
  register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-email', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  );
    register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-zagolovok', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  );
  register_setting(
    'un-pokazaniya-ipu-settings-group', // Имя группы опций
    'un-pokazaniya-ipu-option-logo', // Имя опции
    'un_pokazaniya_ipu_settings_sanitize' // Функция фильтрации введенных данных
  );
 
  add_settings_section(
    'un-pokazaniya-ipu-settings-section', // Имя секции
    '1. Заполните и сохраните настройки', // Заголовок секции
    '', // Функция отображения описания секции (можно оставить пустым)
    'un-pokazaniya-ipu-settings' // Уникальный идентификатор страницы настроек, к которой привязана секция
  );
  
  add_settings_field(
    'un-pokazaniya-ipu-field-maxlength', // Имя поля настроек  
    'Количество знаков в лицевом счёте', // Название поля настроек
    'un_pokazaniya_ipu_settings_maxlength_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );  
  add_settings_field(
    'un-pokazaniya-ipu-field-datan', // Имя поля настроек  
    'День месяца начала приёма показаний ИПУ', // Название поля настроек
    'un_pokazaniya_ipu_settings_datan_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );  
  add_settings_field(
    'un-pokazaniya-ipu-field-datak', // Имя поля настроек  
    'День месяца окончания приёма показаний ИПУ', // Название поля настроек
    'un_pokazaniya_ipu_settings_datak_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );
  add_settings_field(
    'un-pokazaniya-ipu-field-email', // Имя поля настроек  
    'Email для приёма показаний ИПУ', // Название поля настроек
    'un_pokazaniya_ipu_settings_email_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );
  add_settings_field(
    'un-pokazaniya-ipu-field-zagolovok', // Имя поля настроек  
    'Заголовок формы', // Название поля настроек
    'un_pokazaniya_ipu_settings_zagolovok_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );
  add_settings_field(
    'un-pokazaniya-ipu-field-logo', // Имя поля настроек  
    'УРЛ-ссылка на логотип', // Название поля настроек
    'un_pokazaniya_ipu_settings_logo_render', // Функция отображения содержимого поля настроек
    'un-pokazaniya-ipu-settings', // Уникальный идентификатор страницы настроек, к которой привязано поле
    'un-pokazaniya-ipu-settings-section' // Имя секции, к которой привязано поле
  );  
}
add_action('admin_init', 'un_pokazaniya_ipu_settings');


// Отображение содержимого поля настроек
function un_pokazaniya_ipu_settings_maxlength_render() {
  $option_value1 = get_option('un-pokazaniya-ipu-option-maxlength');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-maxlength" value="<?php echo esc_attr($option_value1); ?>">
  <p class="description" id="un-pokazaniya-ipu-option-maxlength-description">По умолчанию 12</p>
  <?php
}
function un_pokazaniya_ipu_settings_datan_render() {
  $option_value2 = get_option('un-pokazaniya-ipu-option-datan');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-datan" value="<?php echo esc_attr($option_value2); ?>">
<p class="description" id="un-pokazaniya-ipu-option-datan-description">По умолчанию 15</p>  
  <?php
}
function un_pokazaniya_ipu_settings_datak_render() {
  $option_value3 = get_option('un-pokazaniya-ipu-option-datak');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-datak" value="<?php echo esc_attr($option_value3); ?>"> 
<p class="description" id="un-pokazaniya-ipu-option-datak-description">По умолчанию 25</p>  
  <?php
}
function un_pokazaniya_ipu_settings_email_render() {
  $option_value4 = get_option('un-pokazaniya-ipu-option-email');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-email" value="<?php echo esc_attr($option_value4); ?>"> 
<p class="description" id="un-pokazaniya-ipu-option-email-description">По умолчанию <?php echo get_option('admin_email'); ?></p>  
  <?php
}
function un_pokazaniya_ipu_settings_zagolovok_render() {
  $option_value5 = get_option('un-pokazaniya-ipu-option-zagolovok');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-zagolovok" value="<?php echo esc_attr($option_value5); ?>"> 
<p class="description" id="un-pokazaniya-ipu-option-zagolovok-description">Передать показания приборов учета горячей воды</p>  
  <?php
}
function un_pokazaniya_ipu_settings_logo_render() {
  $option_value7 = get_option('un-pokazaniya-ipu-option-logo');
  ?>
  <input type="text" name="un-pokazaniya-ipu-option-logo" value="<?php echo esc_attr($option_value7); ?>"> 
<p class="description" id="un-pokazaniya-ipu-option-logo-description">https://.../logo.png</p>  
  <?php
}

function un_pokazaniya_ipu_settings_sanitize($input) {
  return sanitize_text_field($input);
}
// *************************************************************************************************************************
// *************************************************************************************************************************
// Запись файлов street.php и massiv.php в каталог ipu/
if (isset($_POST['submit2'])) {

if (isset($_POST['word_list'])) {
    $word_list = $_POST['word_list'];
       
$rows = explode(PHP_EOL, $word_list);

// Запись улиц
$result1 = [];
foreach ($rows as $row1) {
    $fields1 = explode(";", $row1);
        $entry1 = array(            
            'ulitsa' => $fields1[1],           
        );
        $result1[] = $entry1;
}
sort($result1);
$result2 = [];
$file1 = fopen(plugin_dir_path( __FILE__ ) . 'ipu/street.php', 'w');	 
     foreach ($result1 as $entry1) {		  
        $word = implode(", ", array_map(function ($key, $value) {
                return $value;
                }, array_keys($entry1), $entry1));
        $word = trim($word);
        $result2[] = $word;			  
      }   
$result3 = array_unique($result2); 
if ($file1) {
foreach ($result3 as $res) {		          	
    fwrite($file1, '<option value="' . $res . '">' . $res . '</option>' . PHP_EOL);			  
      }
    fclose($file1); 
    echo '<div class="notice notice-success is-dismissible"><p>Список улиц записан в файл street.php!</p></div>';
    } else {
    echo '<div class="notice notice-error is-dismissible"><p>Не удалось открыть файл street.php для записи.</p></div>';
}
 
// Запись массива показаний
$result = [];
foreach ($rows as $row) {
    $fields = explode(";", $row);
        $entry = array(
            'scht' => $fields[0],
            'ulitsa' => $fields[1],
            'adres' => $fields[2],
            'ipu1' => $fields[3],
            'pkzp1' => $fields[4],
            'ipu2' => $fields[5],
            'pkzp2' => $fields[6],
			'ipu3' => $fields[7],
            'pkzp3' => $fields[8]
        );
        $result[] = $entry;
}
$file2 = fopen(plugin_dir_path( __FILE__ ) . 'ipu/massiv.php', 'w');
  if ($file2) {
	  fwrite($file2, '<?php $mass=array(' . PHP_EOL);
      foreach ($result as $entry) {
          fwrite($file2, "array(" . implode(",", array_map(function ($key, $value) {
              return "'$key' => '$value'";
          }, array_keys($entry), $entry)) . ")," . PHP_EOL );		
      }
	 fwrite($file2, ') ?>');
     fclose($file2);
      echo '<div class="notice notice-success is-dismissible"><p>Массив ИПУ записан в файл massiv.php!</p></div>';
  } else {
      echo '<div class="notice notice-error is-dismissible"><p>Не удалось открыть файл massiv.php для записи.</p></div>';
  }
   
// Запись текстового поля
$file3 = fopen(plugin_dir_path( __FILE__ ) . 'ipu/danniye.txt', 'w'); 
  if ($file3) {   
    foreach ($rows as $row) {
      fwrite($file3, trim($row) . PHP_EOL);
    }
    fclose($file3);  
      echo '<div class="notice notice-success is-dismissible"><p>Данные сохранены!</p></div>';
  } else {	  
echo '<div class="notice notice-error is-dismissible"><p>Не удалось открыть файл danniye.txt для записи.</p></div>'; 
  } 
} 
}
// ****************************************************************************************************************** 
?>