const numeroEntrada = document.getElementById("numeroEntrada");
const tituloNumeroEntrada = document.getElementById("tituloNumeroEntrada");
const resultado = document.getElementById("resultado");
const outputResult = document.getElementById("outputResult");
const tipoConversao = document.getElementById("tipoConversao");

const btnConverter = document.getElementById("btnConverter");

tipoConversao.addEventListener("change", alterarPlaceHolder);

btnConverter.addEventListener("click", conversor);

function alterarPlaceHolder() {
  const type = tipoConversao.value;
  switch (type) {
    case "dr":
      tituloNumeroEntrada.innerText = "Numero em Real/Decimal";
      numeroEntrada.placeholder = "Digite um número decimal";
      numeroEntrada.value = "";
      break;
    case "rd":
      tituloNumeroEntrada.innerText = "Numero em Romano";
      numeroEntrada.placeholder = "Digite um número Romano";
      numeroEntrada.value = "";
      break;
    default:
      tituloNumeroEntrada.innerText = "Numero em Real/Decimal";
      numeroEntrada.placeholder = "Digite um número decimal";
      numeroEntrada.value = "";
  }
}

async function conversor() {
  const numero = numeroEntrada.value;
  var tipo = tipoConversao.value;

  const local = "./classes/conversor.php";
  try {
    const response = await fetch(local, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        type: tipo === "rd" ? "romanoParaDecimal" : "decimalParaRomano",
        value: numero,
      }),
    });

    const data = await response.json();

    if (data.result) {
      if (tipo == "dr")
        resultado.innerHTML =
          "O numero " +
          '<b style="color:#6A0DAD" >' +
          numero +
          "</b>" +
          " (Árabico) em Romano é: " +
          data.result;

      if (tipo == "rd")
        resultado.innerHTML =
          "O numero " +
          '<b style="color:#6A0DAD" >' +
          numero +
          "</b>" +
          " (Romano) em Árabico é: " +
          data.result;
    } else if (data.error) {
      resultado.textContent = data.error;
    }
  } catch (error) {
    console.error("Erro:", error);
    resultado.textContent = "Ocorreu um erro ao processar a conversão.";
  }
}
