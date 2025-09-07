// Valida antes de enviar o formulário
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("quizForm");
  if (form) {
    form.addEventListener("submit", (e) => {
      const selecionado = form.querySelector("input[name='resposta']:checked");
      if (!selecionado) {
        e.preventDefault();
        alert("⚠️ Você precisa selecionar uma opção antes de responder!");
      }
    });

    // Destaque visual na opção escolhida
    const opcoes = form.querySelectorAll(".option");
    opcoes.forEach((op) => {
      op.addEventListener("click", () => {
        opcoes.forEach((o) => o.classList.remove("selected"));
        op.classList.add("selected");
      });
    });
  }
});

// Confirmação antes de reiniciar o quiz
function confirmarReinicio() {
  return confirm("Deseja realmente reiniciar o quiz?");
}
