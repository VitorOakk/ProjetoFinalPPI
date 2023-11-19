$(document).ready(function () {
  $("#save").on("click", function (e) {
    $.ajax({
      url: "../Scripts/salvarBio.php",
      type: "POST",
      data: {
        bio: $(".bio").val(),
      },
    }).done(function (data) {
      console.log(data);
      let jData = JSON.parse(data);
      $(".bio-result").html(jData.bio);
    });
  });
});
