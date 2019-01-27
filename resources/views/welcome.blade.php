<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Weekly Retention Curve of Temper Onboarding Flow - Ruvin</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
<div id="app">


<div>
 <h3> Assumptions</h3>
<p> 
- The chart is only visible for Temper admins <br/>
- The chart has one line per weekly cohort <br/>
- The vertical axis is the percentage of users who have been or are still in this step <br/>
- The horizontal axis represents the step in the onboarding (based on the onboarding percentage)<br/>
- On the first step (X=0) 100% of the users are still active, so all charts start at X=0 Y=100% <br/>
- An export of the User table with relevant information is attached: export.csv<br/>
</p>
</div>
</div>

   <script>
         window.Laravel = <?php echo json_encode([
             'csrfToken' => csrf_token(),
          ]); ?>
   </script>
   <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>


