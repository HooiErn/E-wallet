@extends('layout')
@section('content')


<style>
    .dashboard{
        margin:20px;
    }
</style>
<div class="content">
    <div class="dashboard">
          <h4> Hello, Branch</h4>
             <button style="width:80px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/AgentsRegistration';">Create Agents</button>

             <table class="table-bordered">
                <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>

            </table>
</div> <!-- container -->
</div>

@endsection
