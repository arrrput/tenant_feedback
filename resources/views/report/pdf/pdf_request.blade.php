<html>
<head>
  
  <style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px;height: 50px; }
    footer { position: fixed; bottom: -60px; right: -60px; right: 0px; height: 50px; }
    /* p { page-break-after: always; }
    p:last-child { page-break-after: never; } */
    body{
      font-family: Arial, Helvetica, sans-serif;
    }

    /* .table {
            border-collapse: collapse; 
            border: 0.5px solid rgb(209, 208, 208);
            padding: 5px;
            font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            width: 100%;
        }

        th.lima{
            width: 50%;
            text-align: left;
            border-collapse: collapse; 
            padding: 2px;
        }

        th.empat{
            width: 40%;
            text-align: left;
            border-collapse: collapse; 
            padding: 2px;
        }

        th.satu {
            width: 10%;
            text-align: left;
            border-collapse: collapse; 
            padding: 2px;
        }

        th.dua{
            width: 20%;
            text-align: left;
            border-collapse: collapse; 
            padding: 2px;
        }

        th.tiga {
            width: 30%;
            text-align: left;
            border-collapse: collapse; 
            padding: 2px;
        }
        th{
          background-color: #1b6907;
          padding-left: 10px ;
          padding-right: 10px ;
          color: #ffffff;
          margin: 15px;
        }

        td.border{
            border-collapse: collapse; 
            border: 0.5px solid rgb(209, 208, 208);
        } */

        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    margin-left: auto;
    margin-right: auto;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #014601;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #014601;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #014601;
}
  </style>


</head>
<body>
  <header>
    <img src="{{ public_path("img/bie.png") }}" style=" width: 90px; height: 45px;">
  </header>
  <footer>
    <img src="{{ public_path("img/footer.png") }}" style=" width: 520px; height: 50px;">
  </footer>
  <main>
  </main>

    <table style="margin-bottom: 20px; border: 0; margin-left: auto; margin-right: auto;">
      <tbody>
        <tr>
          <td>
            <b>Name Compancy </b>
          </td>
          <td><b> : </b></td>
          <td>
           {{$request->name_user}} 
          </td>
        </tr>
        
        <tr>
          <td>
            <b>Location </b>
          </td>
          <td><b> : </b></td>
          <td>
           {{$request->lokasi}} Unit {{$request->no_unit}}
          </td>
        </tr>

        <tr>
          <td>
            <b>Date of Request </b>
          </td>
          <td><b> : </b></td>
          <td>
            @if ($finish)
            {{  date('d M Y / H:i', strtotime($finish->created_at)) }}
            @else
              Still Going
            @endif

          </td>
        </tr>

        <tr>
          <td>
            <b>Related Department </b>
          </td>
          <td><b> : </b></td>
          <td>
            {{ $request->department }}
          </td>
        </tr>

      </tbody>
    </table>

    <table class="styled-table" >
      <thead>
        <tr>
          <th class="tiga ">Description</th> 
          <th class="tiga ">Root Cause</th> 
          <th class="tiga ">Correction</th> 
          <th class="satu">Date finish</th>
        </tr>
        
      </thead>
      <tbody>
        <tr>
          <td class="border">{{ $request->description }}</td>
          <td class="border">
            @if ($pg)
              {{ $pg->akar_penyebab }}
              @else
              -
            @endif
            
          </td>
          <td class="border">
            @if ($pg)
              {{ $pg->message }}
            @else
            - 
            @endif
          </td>
          <td class="border">
            @if ($finish)
              {{  date('d M Y', strtotime($finish->created_at)) }}
            @else
            -
            @endif
           
          </td>
        </tr>
        
      </tbody>
    </table>
   

    <table class="styled-table">
      <tbody>
        <tr >
          <td style="text-align: center; "><img style="height: 140px;" src="{{ public_path('storage/img_progress/'.$request->image) }}"/> </td>
          <td style="text-align: center; height: 200px;">
              @if ($finish)
              <img  style="height: 140px;" src="{{ public_path('storage/img_finish/'.$finish->image) }}" /> 
              @endif
            </td>
        </tr>
        <tr>
          <td style="text-align: center;">Before </td>
          <td style="text-align: center;">
            @if ($finish)
              After finish Task 
            @endif
            </td>
        </tr>
      </tbody>
      
    </table>
    
    @if($rate)
    <table class="styled-table" >
      <thead>
        <tr>
          <th class="tiga ">Feedback User</th> 
          <th class="tiga ">Rating</th> 
        </tr>
        
      </thead>
      <tbody>
        <tr height="10">
          <td class="border">{{ $rate->message }}</td>
          <td class="border" align="center">
           @for ($i = 0; $i < $rate->rate_point; $i++ )
           <img class="emojione" style="max-height: 12px;" alt="&#x2b50;" title=":star:" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/64/2b50.png"/>
           @endfor
           
          </td>
         
        </tr>
        
      </tbody>
    </table>
    @endif
    
  </main>
</body>
</html>