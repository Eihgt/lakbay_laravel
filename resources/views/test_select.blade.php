<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

    <!-- Button to Open Modal -->
    <button type="button" class="btn btn-primary" id="openModalBtn">
        Open Modal
    </button>

                    <label for="requestor_id" class="form-label mb-0">Requestor</label>
                    <select class="form-control selectpicker" name="vehicle_id[]" id="vehicle_id" multiple>
                        <option value="">asdasdasd</option>
                        <option value="">asdasdasd</option>

                    </select>


    <script>
        $(document).ready(function() {

            // Open Modal
            $("#openModalBtn").click(function() {
                $("#myModal").modal('show');
            });
        });

    </script>

    <!-- Bootstrap JS -->




</body>
</html>
