@extends('mobile.master')
@section('content')
<?
$shift=Session::get('memberMobile')->shift;
?>
@if($shift==1 || $shift==2)
@include('mobile.electors_vote')
@else
@include('mobile.final_stage')
@endif
@endsection
