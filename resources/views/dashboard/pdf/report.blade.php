<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="invoice.css"></head>
<body style="padding: 3rem">
<div class="text-center">

</div>
<h1> Cars Report</h1>
<div class="card-content collapse show">
    <div class="card-body card-dashboard">
        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
            <thead  class="">
            <tr>

                <th>Users</th>
                <th>Cars</th>
                <th>Companies</th>
                <th>Brands</th>

            </tr>
            </thead>

            <tbody>
            <tr>
                <td>{{App\Models\Client::count()}}</td>
                <td>{{App\Models\Car::count()}}</td>
                <td class="text-end">{{App\Models\Company::count()}}</td>
                <td class="text-end">{{App\Models\Brand::count()}}</td>


            </tr>

            </tbody>

        </table>
        <div class="justify-content-center d-flex">

        </div>
    </div>
</div>
</body>
</html>
