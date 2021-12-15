<div class="box">
    <center>
        <img alt="" class="imgLogo"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHMAAABWCAYAAAD8IqljAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAhdEVYdENyZWF0aW9uIFRpbWUAMjAyMTowNzoyOCAxMDoxODo0OKN2CI4AAATOSURBVHhe7Z3bbtNAEIaTOBG38ABwhcQFAt7/MQABpbScSqEgBOIk2vgQZsIMCk2zmbF317P2fjdx3MzuP//vje0oUSeZTCaTyWQymUyyTOnRFE3TPKTNncxmswe0GQwrOqSYCpPNm06n99c7HKxWq0ehjNTqwEdLofYOGgjGqJGsHg1WdCRLWwMZX0Za0ZEsXQ1kuhppRUey+DKQaWukFR3J4ttARmukFR3JEspARmqkFR2+iH5rgg1KLvkR8GN92b+JptZ1u2BFR7JoVsKuo3pIYySLz+a7jGVFR7KEaLrNmFZ0JEvIZrVj0+ZeQuugsrSI0aRmDgkxdLSdozdiNqeZy0VMHV3nikYfTWnmvIo+dPiaMxh9NqOZe5M+dfie2xsWmtBoQCzoCKWhNVbEWzLRkhYxVkRbNM+ipp1YEWvZNMva/mFFZApmmdZoRZxpky5hUqsVUSbN2YMpzVbEmDJFiQntVgy0oqMLvfZgxUArOnzQSy9WDLSiwydRe7JioBUdIYjSmxUDregISdAerRhoRUcMgvRqxUArOmLitWcrBlrR0QfS3s/L8guVXI10oNAGXpTlOU3lZGhBMm1y+O8b7fgH6Q9MQ35LW6ODNqMR89vpEh/Ag8egafs1kqNh80gIhURHX8TofxNNJrN1hRCoG+bvJhTgSokZKPqNvtNTJ6owM3+JHagUk2Fqjsa+WE0mBW2aIa/Mlsym07vWVqf2nHmPNoPDq7Oqm4Z2jRI8YCRX9ogqTDB4WtX1M3oaHAx0MS8KDBUyjTavFSRBLqvqI/qE21u/nJYMAIEeL+bz2/Q0GrHe1iQroWqaw0VR3KGn3pGuSDzQOcwtcBB4wV7KqnpBJYNB2jsS8sDyqkMcaF0/p5LksRIkQtPsRawDVt4R1TgZQqBWggyq46IsP1CtEwj+gEqSYxRBMhDoexrDCQR6TCXJMKogGUWgL6nEPKMMkoFAz2hMJxCo+XPoqINkhhBoDnID8VtuXR9SiRlykFewLMtTmsuJpXNoDtIBBPqO5nSyrKo3VNIbOUgB0kD7XKE5SAWK25bo59AcZAsUKzTah/M5yA5AoG9JkxMI9BWVBCMH6QEI9IS0OcHXUYl3NAael+U3KvNO0kEycPUqWqG4kqnEGxoDGQj0O5V7YxBBMsuyEq1QeMs9opLOtAmSgUB/0TCdGVSQjOIc2vmiqEuQjI9ABxkkgx8YkHYn8LrXVKLGR5AMBPqDhlUz6CAZeMuVnkNPqUSM1kDadNIm0FEEyUhX6IUi0DYG1nX9hHY5gUB/ricRMKogGby/pJ6cSD7L7WJgVdcH9CcncGD9ppKdjDJIBs+N1JsT10WRDwMhUNEKdQU66iAZzQq9bIJPA6VjYaAhdSSPdIUieC+KhsB57DPt2ovUQE0oqBlfD+GKvm2BDD5IRhOoBq2BmkA1jCZIBlbdMfXuhbYGwjn0KQ3hhdEFyfgKtKuB0tuWfYw2SAbPi+RFK3wZiOPQkK0YfZBMWyN9G2hFR/KgIXD+asgfJ3jzH8pAHBcu0JY0lZNluX0L1RfR/02xBDZnWde3rs3n19c7gbKqT+bF7Ctu7/yBqUc2dNwEHTfWOwEI+mxRFJ9wO4YOKSbD3GTzqO/TOCs6MplMJtMTk8kfMFYgujGYP90AAAAASUVORK5CYII=" />
        <div class="textConvite ">
            Você foi convidado pela(o) {{ $nome }} a se cadastrar na plataforma Dashboard YOUniversity, seja bem vindo!
            <br>
            <br>
            Para se cadastrar clique no botão abaixo.
        </div>
        <a style ="margin-top: 50px;margin-bottom: 50px;" target="_blank" href="{{ $link }}"><button style="background: #069cc2; border-radius: 6px; padding: 15px; cursor: pointer; color: #fff; border: none; font-size: 16px;">Realizar Cadastro</button></a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </center>
        <div>Caso não consiga acessar atraves do botão copie esse link e cole em seu navegador: {{ $link }} </div>

</div>
<style>

    .box{
        width: 100%;
        min-height: 200px;
        background-color: gainsboro;
    }
    .imgLogo{
        width: 150px;
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .textConvite{
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .Btn{
        margin-top: 50px;
        margin-bottom: 50px;
    }
</style>
