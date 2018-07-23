Codeigniter, PHP tips & tricks for developer
=========

This is a list of tips trick &  guide for these people want to learn codeigntier, php and web development
1. [Codeigniter Input for handle PUT & DELETE][1]


Codeigniter JOIN:

```php
$this->db->select('*');
$this->db->from('TableA AS A');// I use aliasing make joins easier
$this->db->join('TableC AS C', 'A.ID = C.TableAId', 'INNER');
$this->db->join('TableB AS B', 'B.ID = C.TableBId', 'INNER');
$result = $this->db->get();
```
CI update data with update method without using other methods where, limit ...
```php
$CI->db->update('allocation_tabs', $tab_data, array('id' => $tab_id), 1);
```

CI get data by get_where
```php
    $tab_detail = $CI->db->get_where('table_name', array('id' => $_id), 1)->row();
```

### Load config in CI
```php
$CI->config->load('email');
var_dump($CI->config->item('fix_spam_box'));
var_dump($CI->config->item('xxx_fix_spam_box'));

if ( $CI->config->item('fix_spam_box') === TRUE) {
}
```
### Convert Image
```php
$im   = imagecreatefromjpeg( 'pic.jpg' );
 imageinterlace( $im , 1);  // or true
imagejpeg( $im ,  './php_interlaced.jpg' , 100);
 imagedestroy( $im );
 ```
### Load module model
```php
$CI->load->module_model('administrator.jobs.job_info_model');
$job->container_type = $CI->job_info_model->get_job_info($job->job_id, 'container_type');
```
### trick for css
```css
min-height: calc(100vh - 200px)
```

### CHECK DATABASE RECORD EXISTS
```sql
SELECT * FROM jobs j
WHERE NOT EXISTS (
  SELECT 'x' FROM legs _l WHERE _l.`job_id` = j.`job_id`
)
ORDER BY job_id;
```
### Check if user use iphone
```javascript
var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
```
### FT log message
```php
log_message('error', 'Client: ' . $_SERVER['SERVER_NAME'] . ' does not have wait_unpack & drop_swap info value!');
```
### check actual link
```php
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
```


**CodeIgniter plugin for Sublime Text**
========
<a href="https://sublime.wbond.net/packages/CodeIgniter%20Snippets" target="_blank">Snippets</a>
<a href="http://stackoverflow.com/questions/16235706/sublime-3-set-key-map-for-function-goto-definition">Key map for Sublime</a>
=========


[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=phplaw%40gmail%2ecom&lc=VN&item_name=PHP%20CI%20Tips%20Tricks&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)
[1]:https://gist.github.com/phplaw/6305193
