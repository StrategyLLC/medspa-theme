<style>
  .vac_email {
    font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
  }

  .vac_email tr {

  }

  .vac_email td {
    padding: 5px 0;
  }

  .vac_email_button {
    display: inline-block;
    padding: 5px 15px;
    background-color: #494949;
    color: white;
    text-decoration: none;
  }

  .vac_email_button:hover {
    display: inline-block;
    padding: 5px 15px;
    background-color: black;
    color: white;
  }
</style>

<table class="vac_email">
  <tr>
    <td>
      <p>Dear {user_name},</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Thank you for filling out Southlakes's virtual consultation form!</p>
      <p>Your customized results have been saved and you can return to our site to view your results at any time.  Please click below to view your results on our website.</p>
    </td>
  </tr>
  <tr>
    <td>
      <p><a class="vac_email_button" href="{results_url}">View your personalized results!</a></p>
    </td>
  </tr>
  <tr>
    <td>
      <p>- {company_name}</p>
    </td>
  </tr>
</table>
