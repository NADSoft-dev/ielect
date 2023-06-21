<?
$settings=DB::table('settings')->where('name','app')->select('data')->first();
if($settings){
$settings=json_decode($settings->data,true);
if(isset($settings['phone']) && $settings['phone']) $settings['tel'][]=$settings['phone'];
if(isset($settings['cell']) && $settings['cell']) $settings['tel'][]=$settings['cell'];
if(isset($settings['tel'])) $settings['tel']=implode(' / ',$settings['tel']);
$settings['name']=isset($settings['name']) ? $settings['name']:false;
$settings['address']=isset($settings['address']) ? $settings['address']:false;
$settings['notes']=isset($settings['notes']) ? $settings['notes']:false;
$settings['app_logo']=isset($settings['app_logo']) ? $settings['app_logo']:false;
$settings['tel']=isset($settings['tel']) ? $settings['tel']:false;
?>
<table style="width:100%;text-align:right;border:1px solid #000;padding:20px;margin-bottom:20px;" dir="rtl">
<tr>
<td width="70">
  @if($settings['app_logo'])
<img src="{{$settings['app_logo']}}" style="max-width:50px;max-height:50px;" alt="">
@endif
</td>
<td>
<table style="width:100%;">
  <tr>
  @if($settings['name'])
  <td style="width:33%;">{{$settings['name']}} </td>
  @endif
  @if($settings['address'])
  <td style="width:33%;">כתובת: {{$settings['address']}} </td>
  @endif
  @if($settings['tel'])
  <td style="width:33%;">טלפון: {{$settings['tel']}}</td>
  @endif
  </tr>
  @if($settings['notes'])
  <tr>
    <td>{{$settings['notes']}}</td>
  </tr>
  @endif


</table>
</td>
</tr>
</table>
<?
}
?>
