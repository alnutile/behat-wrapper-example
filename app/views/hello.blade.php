@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row clearfix">

        @include('examples.example_1_raw_left')
        @include('examples.example_1_raw_right')
        @include('examples.example_2_process_left')
        @include('examples.example_2_process_right')
        @include('examples.example_3_process_hook_left')
        @include('examples.example_3_process_hook_right')
        @include('examples.example_4_incremental_output_left')
        @include('examples.example_4_incremental_output_right')
    </div>
</div>

<div class="container">
    <div class="row clearfix">
        <h3>behat.yml example</h3>
        <pre>
default:
  paths:
    features:  vendor/alnutile/behat-wrapper/test/features
    bootstrap: vendor/alnutile/behat-wrapper/test/features/bootstrap

annotations:
  paths:
    features: features/annotations

closures:
  paths:
    features: features/closures
        </pre>
    </div>
</div>

@stop