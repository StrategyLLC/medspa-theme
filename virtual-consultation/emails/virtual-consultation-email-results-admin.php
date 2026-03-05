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
    <td colspan="2">
      <p>New Virtual Aesthetics Consultation submission received:</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Name:</p>
    </td>
    <td>
      <p>{user_name}</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Phone:</p>
    </td>
    <td>
      <p>{user_phone}</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Email:</p>
    </td>
    <td>
      <p>{user_email}</p>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <p><a class="vac_email_button" href="{results_url}">View Results</a></p>
    </td>
  </tr>
</table>
