<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Report PDF</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ BASEURL }}/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ BASEURL }}/css/Dashboard.css">

  <link rel="stylesheet" href="{{ asset('/css/pdfReport.css') }}">

</head>
<body>
  <div class="report">
    <table class="table reportPDF">
      <thead>
        <tr>
          <th scope="col">
            <img class="headerLogo" src="{{ asset('/img/logoPolbat.png') }}" alt="">
          </th>
          <th scope="col">
            <p>LAPORAN MASUK</p> <p>WISE POLIBATAM</p>
          </th>
          <th scope="col">
            <p>Created At :</p> <p>{{ $created_at }}</p>
          </th>
        </tr>
      </thead>
    </table>

    <div class="reportBody">
      <table>
        <tbody>
          <tr>
            <td>
                <b>Status</b>
            </td>
            <td>
                <b>:</b>
            </td>
            <td>
                {{ $report->status }} 
            </td>
          </tr>
          <tr>
            <td>
                <b>Judul</b>
            </td>
            <td>
                <b>:</b>
            </td>
            <td>
                {{ $report->title }}
            </td>
          </tr>
          <tr>
            <td>
                <b>Category</b>
            </td>
            <td>
                <b>:</b>
            </td>
            <td>
                {{ $report->category }}
            </td>
          </tr>
          <tr>
            <td>
                <b>Pihak Yang Diduga</b>
            </td>
            <td>
                <b>:</b>
            </td>
            <td>
                @foreach ($report->suspect as $suspect)
                   <span>{{ $loop->iteration }}. ( {{ $suspect[0] }}, {{ $suspect[1] }} ) </span>
                @endforeach
            </td>
          </tr>
          <tr>
            <td>
                <b>Uraian</b>
            </td>
            <td>
                <b>:</b>
            </td>
          </tr>
        </tbody>
      </table>
  
      <table>
        <tbody>
          <tr class="uraian">
            <td class="uraian">
              {!! $report->description !!} 
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
    

    <script src="{{ BASEURL }}/bootstrap-4.5.3/js/jquery-3.5.1.slim.min.js"></script>
    <script src="{{ BASEURL }}/bootstrap-4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ BASEURL }}/bootstrap-4.5.3/js/popper.min.js"></script>
</body>
</html>