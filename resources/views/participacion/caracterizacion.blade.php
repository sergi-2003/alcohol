<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Participación | Un Sorbito Hoy, Un Problema Mañana</title>
<meta name="description" content="Participa en Un Sorbito Hoy, Un Problema Mañana y aprende sobre prevención del consumo de alcohol en menores de edad.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{
  --azul:#1A5E8A; --verde:#1E7A45; --verde-b:#27AE60; --tinta:#12303B; --texto:#2B3C45; --suave:#586A73;
  --bruma:#EDF3F4; --linea:#D5E0E3; --rojo:#B9382F; --dorado:#F1C40F; --naranja:#F39C12;
  --titulos:'Nunito','Trebuchet MS',Arial,sans-serif; --cuerpo:'Inter',Arial,sans-serif;
}
*{box-sizing:border-box;margin:0}
html{scroll-behavior:smooth}
body{min-height:100vh;font-family:var(--cuerpo);font-size:17px;line-height:1.6;color:var(--texto);
  background:linear-gradient(rgba(237,243,244,.94),rgba(255,255,255,.98)),url("{{ asset('build/img/fondo.webp') }}") center top/cover fixed no-repeat}
a{text-decoration:none;color:inherit}
button,input,select{font-family:inherit}
:focus-visible{outline:3px solid var(--naranja);outline-offset:2px}
h1,h2,h3{font-family:var(--titulos);font-weight:800;color:var(--azul);line-height:1.15}
.page{width:min(1180px,calc(100% - 36px));margin:0 auto;padding:24px 0 60px}
.card{background:#fff;border:1px solid var(--linea);border-radius:14px}

/* =========================================================
   CUERPO DE PARTICIPACIÓN
   Avatar grande a la izquierda + formulario compacto
========================================================= */

.participation-layout{
  display:grid;
  grid-template-columns:minmax(280px,320px) minmax(0,780px);
  justify-content:center;
  align-items:start;
  gap:28px;
  margin:20px 0 24px;
}

.form-column{
  min-width:0;
  width:100%;
}

.form-column .messages{
  margin-bottom:0;
}

.form-card{
  width:100%;
  margin:0;
  padding:28px 30px;
}

.form-section{
  padding-bottom:23px;
  margin-bottom:23px;
}

.fields-grid{gap:16px}
.field label{font-size:15px}
.form-control,.form-select{min-height:48px;font-size:15px}
.field-help,.field-error{font-size:13px}

.guide-panel{
  position:sticky;
  top:24px;
  min-height:610px;
  padding:22px 18px 0;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:flex-end;
  overflow:hidden;
  background:
    radial-gradient(circle at 50% 28%, rgba(39,174,96,.10), transparent 34%),
    linear-gradient(180deg,#f5fafb 0%,#eaf3f5 100%);
  border:1px solid var(--linea);
  border-radius:18px;
  box-shadow:0 12px 35px rgba(18,48,59,.09);
}

.guide-panel::before{
  content:"";
  position:absolute;
  width:210px;
  height:210px;
  top:110px;
  border-radius:50%;
  background:rgba(255,255,255,.58);
  pointer-events:none;
}

.guide-label{
  position:relative;
  z-index:2;
  display:inline-flex;
  align-items:center;
  gap:8px;
  margin-bottom:10px;
  padding:7px 13px;
  border-radius:99px;
  background:#E6F4EC;
  color:var(--verde);
  font-size:12px;
  font-weight:800;
}

.guide-bubble-large{
  position:relative;
  z-index:3;
  width:min(100%,265px);
  margin-bottom:12px;
  padding:15px 17px;
  background:#fff;
  border:1px solid var(--linea);
  border-radius:16px;
  box-shadow:0 8px 20px rgba(18,48,59,.10);
}

.guide-bubble-large::after{
  content:"";
  position:absolute;
  left:44px;
  bottom:-9px;
  width:16px;
  height:16px;
  background:#fff;
  border-right:1px solid var(--linea);
  border-bottom:1px solid var(--linea);
  transform:rotate(45deg);
}

.guide-bubble-large strong{
  display:block;
  margin-bottom:4px;
  color:var(--verde);
  font-family:var(--titulos);
  font-size:20px;
}

.guide-bubble-large span{
  display:block;
  color:var(--suave);
  font-size:13px;
  line-height:1.45;
}

.guide-avatar-large{
  position:relative;
  z-index:2;
  width:100%;
  height:420px;
  display:flex;
  align-items:flex-end;
  justify-content:center;
}

.guide-avatar-large img{
  width:310px;
  height:420px;
  object-fit:contain;
  object-position:center bottom;
  filter:drop-shadow(0 18px 22px rgba(18,48,59,.16));
}

/* HEADER */
.main-header{position:relative;display:block;margin-bottom:24px;padding:30px 32px 0;background:#fff;border:1px solid var(--linea);border-radius:14px;overflow:hidden}
.main-header::before{content:"";position:absolute;inset:0 0 auto 0;height:5px;background:linear-gradient(90deg,var(--verde),var(--azul) 60%,var(--dorado))}
.mh-main{min-width:0;padding-bottom:26px}
.brand{display:flex;align-items:center;gap:22px;width:fit-content;margin-bottom:22px}
.brand-logo{height:62px;width:auto;max-width:210px;padding-right:22px;border-right:2px solid var(--linea);object-fit:contain}
.brand-campaign{display:block;font-family:var(--titulos);font-weight:800;font-size:18px;color:var(--azul)}
.brand-content h1{font-size:clamp(26px,3.2vw,36px);font-weight:900;color:var(--verde)}
.brand-content p{margin-top:4px;font-size:16px;color:var(--suave)}
.progress-card{padding-top:18px;border-top:1px solid var(--linea)}

.progress-header{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:12px}
.progress-title{display:flex;align-items:center;gap:12px}
.progress-icon{width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:#fff;color:var(--verde);font-size:18px}
.progress-title strong{display:block;font-family:var(--titulos);font-weight:800;font-size:18px;color:var(--tinta)}
.progress-title span{display:block;font-size:14px;color:var(--suave)}
.progress-count{padding:4px 12px;border-radius:8px;background:linear-gradient(135deg,var(--dorado),var(--naranja));color:var(--tinta);font-weight:800;white-space:nowrap}
.progress-count strong{font-family:var(--titulos);font-size:18px}
.progress-bar{height:8px;margin-bottom:16px;border-radius:99px;background:#D3DFE2;overflow:hidden}
.progress-value{display:block;width:33.333%;height:100%;background:var(--verde);border-radius:inherit}
.progress-steps{display:flex;align-items:center}
.progress-step{flex:1;display:flex;align-items:center;gap:8px;min-width:0}
.step-circle{width:34px;height:34px;flex-shrink:0;display:grid;place-items:center;border-radius:50%;background:#D3DFE2;color:#5F7079;font-size:14px}
.progress-step.active .step-circle{background:var(--verde);color:#fff}
.step-content strong{display:block;font-family:var(--titulos);font-weight:800;font-size:14px;color:var(--suave);line-height:1.2}
.step-content span{display:block;font-size:13px;color:var(--suave);line-height:1.2}
.progress-step.active .step-content strong{color:var(--verde)}
.step-connector{flex:0 0 18px;height:2px;margin:0 6px;background:#C4D3D7}

/* INTRO Y PROGRAMA */
.intro,.about-program,.form-card{padding:32px 36px;margin-bottom:20px;background:#fff;border:1px solid var(--linea);border-radius:14px}
.intro-label{display:inline-flex;align-items:center;gap:8px;margin-bottom:12px;padding:6px 14px;border-radius:99px;background:#FFF6D0;color:#7A5600;font-size:15px;font-weight:700}
.intro h2{font-size:clamp(30px,4.4vw,42px);font-weight:900;color:var(--azul);margin-bottom:12px}
.intro p{max-width:66ch;font-size:18px}
.about-program{display:grid;grid-template-columns:64px 1fr;gap:22px;background:var(--bruma);scroll-margin-top:24px}
.about-program-icon{width:64px;height:64px;display:grid;place-items:center;border-radius:14px;background:var(--azul);color:#fff;font-size:28px}
.about-program-label{display:block;margin-bottom:4px;font-weight:700;color:var(--verde);font-size:15px}
.about-program-content h3{font-size:26px;margin-bottom:10px}
.about-program-content p{margin-bottom:10px;max-width:68ch}
.about-program-items{display:flex;flex-wrap:wrap;gap:10px;margin-top:16px}
.about-item{display:inline-flex;align-items:center;gap:8px;padding:9px 16px;background:#fff;border:1px solid var(--linea);border-radius:99px;font-weight:700;color:var(--tinta)}
.about-item i{color:var(--verde)}

/* MENSAJES */
.alert{display:flex;gap:12px;padding:14px 18px;margin-bottom:12px;border-radius:10px;font-size:16px}
.alert-success{background:#E6F4EC;color:#14532D;border:1px solid #BFE0CD}
.alert-error{background:#FCECEA;color:#8E2A23;border:1px solid #F0C6C2}

/* FORMULARIO */
.form-section{padding-bottom:30px;margin-bottom:30px;border-bottom:1px solid var(--linea)}
.section-heading{display:flex;gap:14px;align-items:flex-start;margin-bottom:22px}
.section-icon{width:46px;height:46px;flex-shrink:0;display:grid;place-items:center;border-radius:12px;background:var(--bruma);color:var(--azul);font-size:21px}
.section-heading h3{font-size:24px}
.section-heading p{margin-top:4px;color:var(--suave);font-size:16px}
.fields-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.field{min-width:0}.field.full{grid-column:1/-1}
.field label{display:flex;gap:5px;margin-bottom:7px;font-size:16px;font-weight:600;color:var(--tinta)}
.required{color:var(--rojo)}
.input-wrap{position:relative}
.input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#6B7D86;font-size:18px;pointer-events:none}
.form-control,.form-select{width:100%;min-height:52px;padding:12px 14px;background:#fff;border:1.5px solid #B9C9CE;border-radius:10px;color:var(--tinta);font-size:16px}
.with-icon{padding-left:44px!important}
.form-control:focus,.form-select:focus{outline:none;border-color:var(--azul);box-shadow:0 0 0 4px rgba(26,94,138,.15)}
.form-control::placeholder{color:#7C8C94}
.field-help{margin-top:5px;font-size:14px;color:var(--suave)}
.field-error{margin-top:5px;font-size:14px;font-weight:600;color:var(--rojo)}

/* ANÓNIMO */
.anonymous-option{display:grid;grid-template-columns:auto 1fr;gap:16px;align-items:center;margin-bottom:24px;padding:20px 22px;background:var(--bruma);border:1.5px solid var(--linea);border-radius:12px;transition:.2s}
.anonymous-option.active{background:#E6F4EC;border-color:var(--verde-b)}
.anonymous-option-icon{width:48px;height:48px;display:grid;place-items:center;border-radius:12px;background:var(--azul);color:#fff;font-size:22px}
.anonymous-option.active .anonymous-option-icon{background:var(--verde)}
.anonymous-option-content{display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.anonymous-title strong{display:block;font-family:var(--titulos);font-weight:800;font-size:19px;color:var(--tinta)}
.anonymous-title span{display:block;font-size:16px;color:var(--suave);max-width:46ch}
.anonymous-switch{display:inline-flex;align-items:center;gap:10px;cursor:pointer;user-select:none}
.anonymous-switch input{position:absolute;opacity:0;width:1px;height:1px}
.anonymous-slider{position:relative;width:52px;height:30px;border-radius:99px;background:#9DB0B6;transition:.2s;flex-shrink:0}
.anonymous-slider::after{content:"";position:absolute;top:3px;left:3px;width:24px;height:24px;border-radius:50%;background:#fff;transition:.2s}
.anonymous-switch input:checked+.anonymous-slider{background:var(--verde)}
.anonymous-switch input:checked+.anonymous-slider::after{transform:translateX(22px)}
.anonymous-switch input:focus-visible+.anonymous-slider{outline:3px solid var(--naranja);outline-offset:2px}
.anonymous-label{font-weight:700;color:var(--tinta);font-size:16px}
.field.anonymous-disabled{opacity:.5}
.field.anonymous-disabled .form-control,.field.anonymous-disabled .form-select{background:#EEF2F3;cursor:not-allowed}

/* UBICACIÓN */
.location-box{padding:22px;background:var(--bruma);border-radius:12px}
.location-status{display:flex;align-items:center;gap:14px;padding:14px 16px;margin-bottom:20px;border-radius:10px;background:#fff;border:1px solid var(--linea)}
.location-status.detected{background:#E6F4EC;border-color:#BFE0CD}
.location-status.manual{background:#FFF6D0;border-color:#F0DFA0}
.location-status-icon{font-size:24px;color:var(--azul)}
.location-status.detected .location-status-icon{color:var(--verde)}
.location-status-content strong{display:block;font-size:17px;color:var(--tinta)}
.location-status-content span{font-size:15px;color:var(--suave)}
.location-loading{animation:pulse 1.5s infinite}
@keyframes pulse{50%{opacity:.45}}
.location-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:20px}
.location-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:48px;padding:10px 20px;border-radius:10px;border:2px solid var(--azul);background:#fff;color:var(--azul);font-size:16px;font-weight:700;cursor:pointer;transition:.2s}
.location-btn:hover{background:var(--bruma)}
.location-btn.primary{background:var(--azul);color:#fff}
.location-btn.primary:hover{background:#144A6C}
.coordinates{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:18px}
.coordinate{padding:10px 14px;background:#fff;border:1px solid var(--linea);border-radius:10px}
.coordinate span{display:block;font-size:14px;color:var(--suave)}
.coordinate strong{font-size:16px}
.accuracy-status{display:none;margin-top:12px;padding:11px 14px;border-radius:10px;font-size:14px;font-weight:600;background:#fff;border:1px solid var(--linea);color:var(--suave)}
.accuracy-status.ok{display:block;border-left:4px solid var(--verde)}
.accuracy-status.warn{display:block;border-left:4px solid #d99a00}
.accuracy-status.error{display:block;border-left:4px solid #c0392b}
.privacy-box{display:flex;gap:14px;margin-top:20px;padding:16px 18px;background:#fff;border-left:4px solid var(--verde);border-radius:0 10px 10px 0}
.privacy-box i{font-size:22px;color:var(--verde)}
.privacy-box p{font-size:16px;color:var(--suave)}
.privacy-box strong{color:var(--tinta)}

/* CONSENTIMIENTO */
.terms-preview{display:flex;gap:14px;align-items:center;margin-bottom:18px;padding:18px 20px;background:var(--bruma);border-radius:12px}
.terms-preview-icon{width:46px;height:46px;flex-shrink:0;display:grid;place-items:center;border-radius:12px;background:var(--azul);color:#fff;font-size:21px}
.terms-preview-content strong{display:block;font-family:var(--titulos);font-weight:800;font-size:19px;color:var(--tinta)}
.terms-preview-content span{display:block;font-size:16px;color:var(--suave)}
.terms-btn{margin-top:6px;padding:4px 0;border:0;background:none;color:var(--azul);font-size:16px;font-weight:700;cursor:pointer;text-decoration:underline;text-underline-offset:3px}
.consent-box{padding:6px 22px;border:1.5px solid var(--linea);border-radius:12px}
.check-row{display:flex;gap:14px;align-items:flex-start;padding:18px 0}
.check-row+.check-row{border-top:1px solid var(--linea)}
.check-row input{width:24px;height:24px;margin-top:2px;flex-shrink:0;accent-color:var(--verde);cursor:pointer}
.check-row label{font-size:16px;color:var(--suave);cursor:pointer}
.check-row label strong{color:var(--tinta)}
.form-footer{display:flex;align-items:center;justify-content:space-between;gap:24px;padding-top:28px}
.footer-info{display:flex;gap:10px;align-items:center;max-width:44ch;font-size:15px;color:var(--suave)}
.footer-info i{font-size:20px;color:var(--verde)}
.submit-btn{display:inline-flex;align-items:center;justify-content:center;gap:12px;min-height:58px;padding:14px 30px;border:0;border-radius:99px;background:linear-gradient(135deg,var(--dorado),var(--naranja));color:var(--tinta);font-family:var(--titulos);font-size:19px;font-weight:900;cursor:pointer;box-shadow:0 6px 16px rgba(18,48,59,.2);transition:transform .2s,filter .2s}
.submit-btn:hover{transform:translateY(-2px);filter:brightness(1.05)}
.page-footer{margin-top:24px;text-align:center;font-size:15px;color:var(--suave)}

/* MODAL DE ADVERTENCIA PARA PARTICIPACIÓN ANÓNIMA */
.anonymous-warning-modal .terms-dialog{width:min(650px,100%)}
.anonymous-warning-modal .terms-header-icon{background:#B77900}
.anonymous-warning-modal .terms-notice{background:#FFF6D0;border:1px solid #F0DFA0}
.anonymous-warning-modal .terms-notice>i{color:#8A5A00}
.anonymous-warning-modal .warning-list{display:grid;gap:12px;margin:16px 0;padding:0;list-style:none}
.anonymous-warning-modal .warning-list li{display:flex;align-items:flex-start;gap:11px;padding:13px 14px;border:1px solid var(--linea);border-radius:10px;background:#fff}
.anonymous-warning-modal .warning-list i{color:var(--rojo);font-size:20px;flex-shrink:0;margin-top:2px}
.anonymous-warning-modal .warning-list strong{display:block;color:var(--tinta);margin-bottom:2px}
.anonymous-warning-modal .warning-list span{display:block;color:var(--suave);font-size:15px}
.anonymous-warning-modal .anonymous-data-note{padding:13px 15px;background:#E6F4EC;border-left:4px solid var(--verde);border-radius:0 9px 9px 0;color:#14532D;font-size:14px}
.anonymous-warning-actions{display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap}
.anonymous-warning-actions button{min-height:46px;padding:10px 17px;border-radius:10px;font:700 15px var(--cuerpo);cursor:pointer}
.anonymous-warning-actions .btn-register{border:1px solid var(--azul);background:#fff;color:var(--azul)}
.anonymous-warning-actions .btn-continue{border:0;background:var(--verde);color:#fff}
.anonymous-warning-actions .btn-continue:hover{background:#186338}
@media(max-width:600px){.anonymous-warning-modal{padding:12px}.anonymous-warning-modal .terms-header{padding:15px}.anonymous-warning-modal .terms-body{padding:17px}.anonymous-warning-modal .terms-footer{align-items:stretch;flex-direction:column}.anonymous-warning-actions{display:grid;grid-template-columns:1fr}.anonymous-warning-actions button{width:100%}}

/* MODAL TÉRMINOS */
.terms-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:20px}
.terms-modal.active{display:flex}
.terms-overlay{position:absolute;inset:0;background:rgba(18,48,59,.72)}
.terms-dialog{position:relative;width:min(760px,100%);max-height:90vh;display:flex;flex-direction:column;background:#fff;border-radius:14px;overflow:hidden}
.terms-header{display:flex;align-items:center;gap:14px;padding:18px 22px;background:var(--bruma);border-bottom:1px solid var(--linea)}
.terms-header-icon{width:44px;height:44px;display:grid;place-items:center;border-radius:10px;background:var(--azul);color:#fff;font-size:20px}
.terms-header-copy{flex:1}
.terms-header-copy>span{display:block;font-size:14px;font-weight:700;color:var(--verde)}
.terms-header-copy h2{font-size:22px}
.terms-close{width:44px;height:44px;border:0;border-radius:50%;background:#fff;color:var(--tinta);font-size:18px;cursor:pointer}
.terms-body{overflow-y:auto;padding:24px}
.terms-notice{display:flex;gap:12px;margin-bottom:12px;padding:14px 16px;background:var(--bruma);border-radius:10px;font-size:16px}
.terms-notice>i{color:var(--azul);font-size:20px}
.terms-section{padding:18px 0;border-bottom:1px solid var(--linea)}
.terms-section h3{display:flex;align-items:center;gap:10px;margin-bottom:8px;font-size:19px;color:var(--verde)}
.terms-section p{margin-bottom:8px;font-size:16px}
.terms-section small{font-size:14px;color:var(--suave)}
.terms-highlight{display:flex;gap:10px;margin-top:12px;padding:12px 14px;background:#E6F4EC;border-radius:10px;font-size:16px;color:#14532D}
.terms-final-notice{display:flex;gap:12px;margin-top:20px;padding:16px;background:#FFF6D0;border-radius:10px}
.terms-final-notice>i{font-size:22px;color:#7A5600}
.terms-final-notice strong{display:block;color:#5C4100}
.terms-final-notice p{font-size:16px}
.terms-footer{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:14px 22px;border-top:1px solid var(--linea);background:var(--bruma)}
.terms-footer>span{font-size:14px;color:var(--suave)}
.terms-accept-btn{display:inline-flex;align-items:center;gap:8px;min-height:48px;padding:10px 24px;border:0;border-radius:10px;background:var(--verde);color:#fff;font-size:16px;font-weight:700;cursor:pointer}
.terms-accept-btn:hover{background:#186338}


@media (max-width:1040px){
  .participation-layout{
    grid-template-columns:260px minmax(0,1fr);
    gap:20px;
  }

  .guide-panel{
    min-height:560px;
  }

  .guide-avatar-large{
    height:360px;
  }

  .guide-avatar-large img{
    width:270px;
    height:360px;
  }

  .form-card{
    padding:25px 24px;
  }
}

@media (max-width:820px){
  .main-header{padding:26px 18px 0}
  .mh-main{padding-bottom:18px}

  .participation-layout{
    grid-template-columns:1fr;
    gap:18px;
    margin-top:16px;
  }

  .guide-panel{
    position:relative;
    top:auto;
    min-height:400px;
    padding-top:18px;
  }

  .guide-avatar-large{
    height:270px;
  }

  .guide-avatar-large img{
    width:220px;
    height:290px;
  }

  .fields-grid{grid-template-columns:1fr}.field.full{grid-column:auto}
  .about-program{grid-template-columns:1fr}
  .intro,.about-program,.form-card{padding:24px 20px}
}
@media (max-width:600px){
  .page{width:calc(100% - 20px);padding-top:10px}

  .guide-panel{
    min-height:360px;
    border-radius:16px;
  }

  .guide-bubble-large{
    width:94%;
  }

  .guide-avatar-large{
    height:230px;
  }

  .guide-avatar-large img{
    width:190px;
    height:250px;
  }

  .form-card{
    padding:22px 16px;
  }
  .brand{flex-direction:column;align-items:flex-start;gap:12px}
  .brand-logo{border-right:0;padding-right:0;height:54px}
  .brand-campaign{font-size:17px}
  .progress-steps{flex-direction:column;align-items:stretch}
  .progress-step{padding:6px 0}
  .step-content strong,.step-content span{font-size:16px}
  .step-connector{flex:none;width:2px;height:12px;margin:0 0 0 16px}
  .anonymous-option{grid-template-columns:1fr}
  .anonymous-option-content{flex-direction:column;align-items:stretch}
  .anonymous-switch{justify-content:space-between;padding-top:12px;border-top:1px solid var(--linea)}
  .coordinates{grid-template-columns:1fr}
  .location-actions{flex-direction:column}.location-btn{width:100%}
  .form-footer{flex-direction:column;align-items:stretch}
  .footer-info{max-width:none}
  .form-actions{width:100%;flex-direction:column}
  .back-btn,.submit-btn{width:100%}
  .terms-preview{align-items:flex-start}
  .terms-footer{flex-direction:column;align-items:stretch}.terms-accept-btn{width:100%;justify-content:center}
  .terms-dialog{max-height:94vh}
}
@media (prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important;scroll-behavior:auto!important}}

/* =========================================================
   AJUSTE FINAL — FORMULARIO MÁS COMPACTO + AVATAR GRANDE
   Estas reglas se dejan al final para que prevalezcan sobre
   estilos anteriores del archivo.
========================================================= */

.participation-layout{
  width:100%;
  max-width:1120px;
  margin:20px auto 24px;
  display:grid;
  grid-template-columns:320px minmax(0,760px);
  justify-content:center;
  gap:28px;
  align-items:start;
}

.guide-panel{
  position:sticky;
  top:22px;
  min-height:620px;
  padding:20px 16px 0;
  border-radius:20px;
}

.guide-avatar-large{
  height:430px;
}

.guide-avatar-large img{
  width:320px;
  height:430px;
}

.form-column{
  width:100%;
  min-width:0;
}

.form-column .messages{
  margin:0 0 12px;
}

.form-card{
  width:100%;
  margin:0;
  padding:24px 26px;
  border-radius:16px;
}

.form-section{
  padding-bottom:20px;
  margin-bottom:20px;
}

.section-heading{
  gap:12px;
  margin-bottom:17px;
}

.section-icon{
  width:42px;
  height:42px;
  border-radius:11px;
  font-size:19px;
}

.section-heading h3{
  font-size:21px;
}

.section-heading p{
  font-size:14px;
}

.fields-grid{
  gap:14px 16px;
}

.field label{
  margin-bottom:6px;
  font-size:14px;
}

.form-control,
.form-select{
  min-height:46px;
  padding:10px 13px;
  font-size:14px;
  border-radius:9px;
}

.with-icon{
  padding-left:41px !important;
}

.input-icon{
  left:13px;
  font-size:16px;
}

.anonymous-option{
  margin-bottom:18px;
  padding:16px 18px;
}

.anonymous-title strong{
  font-size:17px;
}

.anonymous-title span{
  font-size:14px;
}

.location-box{
  padding:18px;
}

.location-status{
  margin-bottom:16px;
  padding:12px 14px;
}

.privacy-box{
  margin-top:16px;
  padding:13px 15px;
}

.privacy-box p{
  font-size:14px;
}

.terms-preview{
  margin-bottom:14px;
  padding:15px 17px;
}

.terms-preview-content strong{
  font-size:17px;
}

.terms-preview-content span{
  font-size:14px;
}

.consent-box{
  padding:4px 18px;
}

.check-row{
  gap:11px;
  padding:14px 0;
}

.check-row label{
  font-size:14px;
}

.form-footer{
  padding-top:20px;
  gap:18px;
}

.form-actions{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:wrap;
}

.back-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  min-height:52px;
  padding:12px 22px;
  border:1.5px solid var(--azul);
  border-radius:99px;
  background:#fff;
  color:var(--azul);
  font-family:var(--titulos);
  font-size:16px;
  font-weight:800;
  transition:transform .2s ease,background .2s ease,color .2s ease,box-shadow .2s ease;
}

.back-btn:hover{
  background:var(--bruma);
  color:var(--azul);
  transform:translateY(-2px);
  box-shadow:0 6px 14px rgba(18,48,59,.10);
}

.footer-info{
  font-size:13px;
}

.submit-btn{
  min-height:52px;
  padding:12px 23px;
  font-size:17px;
}




/* =========================================================
   BOTÓN VOLVER EN EL HEADER
========================================================= */

.main-header{
  position:relative;
}

.header-back{
  position:absolute;
  top:22px;
  right:24px;
  z-index:10;

  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;

  min-height:42px;
  padding:9px 16px;

  border:1.5px solid #c9d8dd;
  border-radius:999px;
  background:#ffffff;

  color:var(--azul);
  font-family:var(--titulos);
  font-size:14px;
  font-weight:800;

  box-shadow:0 5px 14px rgba(18,48,59,.08);
  transition:transform .2s ease,background .2s ease,border-color .2s ease,box-shadow .2s ease;
}

.header-back i{
  font-size:17px;
}

.header-back:hover{
  background:var(--bruma);
  border-color:#aec5cd;
  color:var(--azul);
  transform:translateY(-2px);
  box-shadow:0 8px 18px rgba(18,48,59,.12);
}

/* El botón vive en el encabezado; ya no se muestra en el pie del formulario. */
.form-actions{
  display:flex;
  align-items:center;
  justify-content:flex-end;
  flex:0 0 auto;
}

@media (max-width:820px){
  .header-back{
    top:18px;
    right:18px;
    min-height:40px;
    padding:8px 13px;
    font-size:13px;
  }

  .mh-main{
    padding-right:105px;
  }
}

@media (max-width:600px){
  .header-back{
    top:14px;
    right:14px;
  }

  .header-back span{
    display:none;
  }

  .header-back{
    width:40px;
    padding:0;
  }

  .header-back i{
    font-size:18px;
  }

  .mh-main{
    padding-right:55px;
  }
}

/* =========================================================
   RESPONSIVE FINAL
========================================================= */

@media (max-width:1040px){
  .participation-layout{
    grid-template-columns:270px minmax(0,1fr);
    gap:20px;
  }

  .guide-panel{
    min-height:560px;
  }

  .guide-avatar-large{
    height:365px;
  }

  .guide-avatar-large img{
    width:275px;
    height:365px;
  }
}

@media (max-width:820px){
  .participation-layout{
    grid-template-columns:1fr;
    gap:18px;
  }

  .guide-panel{
    position:relative;
    top:auto;
    min-height:410px;
  }

  .guide-avatar-large{
    height:285px;
  }

  .guide-avatar-large img{
    width:225px;
    height:295px;
  }

  .form-card{
    padding:22px 20px;
  }

  .fields-grid{
    grid-template-columns:1fr;
  }

  .field.full{
    grid-column:auto;
  }
}

@media (max-width:600px){
  .participation-layout{
    margin-top:14px;
  }

  .guide-panel{
    min-height:365px;
    padding-left:12px;
    padding-right:12px;
  }

  .guide-bubble-large{
    width:94%;
    padding:14px 15px;
  }

  .guide-avatar-large{
    height:225px;
  }

  .guide-avatar-large img{
    width:190px;
    height:250px;
  }

  .form-card{
    padding:20px 15px;
  }
}


/* =========================================================
   GUÍA CON AUDIO
========================================================= */

.guide-panel.guide-speaking .guide-bubble-large{
  border-color:rgba(30,122,69,.45);
  box-shadow:0 10px 28px rgba(30,122,69,.12);
}

.guide-panel.guide-speaking .guide-label{
  background:#DFF2E7;
}

.guide-panel.guide-speaking .guide-avatar-large img{
  animation:guiaHabla 1.8s ease-in-out infinite;
}

@keyframes guiaHabla{
  0%,100%{
    transform:translateY(0) scale(1);
  }
  50%{
    transform:translateY(-5px) scale(1.012);
  }
}

.guide-audio-btn{
  position:relative;
  z-index:4;

  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;

  min-height:40px;
  margin:-2px 0 10px;
  padding:9px 15px;

  border:1px solid #C9DDD3;
  border-radius:999px;

  background:#fff;
  color:var(--azul);

  font-size:13px;
  font-weight:800;

  cursor:pointer;

  box-shadow:0 5px 14px rgba(18,48,59,.07);

  transition:
    transform .2s ease,
    background .2s ease,
    border-color .2s ease,
    color .2s ease,
    box-shadow .2s ease;
}

.guide-audio-btn:hover{
  transform:translateY(-2px);
  background:var(--bruma);
  border-color:#AFC8BC;
}

.guide-audio-btn.playing{
  background:#E6F4EC;
  border-color:#BFE0CD;
  color:var(--verde);
}

.guide-audio-actions{
  position:relative;
  z-index:4;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  flex-wrap:wrap;
  margin:-2px 0 8px;
}

.guide-audio-actions .guide-audio-btn{
  margin:0;
}

.guide-stop-btn{
  position:relative;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  min-height:40px;
  padding:9px 15px;
  border:1px solid #E2C7C4;
  border-radius:999px;
  background:#fff;
  color:#B9382F;
  font-size:13px;
  font-weight:800;
  cursor:pointer;
  box-shadow:0 5px 14px rgba(18,48,59,.07);
  transition:
    transform .2s ease,
    background .2s ease,
    border-color .2s ease,
    color .2s ease,
    box-shadow .2s ease,
    opacity .2s ease;
}

.guide-stop-btn:hover:not(:disabled){
  transform:translateY(-2px);
  background:#FCECEA;
  border-color:#D9AAA5;
}

.guide-stop-btn:disabled{
  opacity:.45;
  cursor:not-allowed;
  box-shadow:none;
}

.guide-stop-btn i{
  font-size:16px;
}

.guide-audio-btn i{
  font-size:16px;
}

.guide-audio-status{
  display:block;
  min-height:18px;
  margin:-3px 0 8px;

  color:var(--suave);

  font-size:11px;
  text-align:center;
}

.guide-audio-status.speaking{
  color:var(--verde);
  font-weight:800;
}

@media (max-width:820px){
  .guide-audio-actions{
    margin:0 0 9px;
  }

  .guide-audio-btn{
    margin:0;
  }
}

@media (prefers-reduced-motion:reduce){
  .guide-panel.guide-speaking .guide-avatar-large img{
    animation:none;
  }
}

</style>
</head>
<body>
<div class="page">

<header class="main-header">
  <a href="{{ route('home') }}" class="header-back" aria-label="Volver al inicio">
    <i class="bi bi-arrow-left"></i>
    <span>Volver</span>
  </a>

  <div class="mh-main">
    <a href="{{ url('/') }}" class="brand" aria-label="Ir al inicio de Un Sorbito Hoy, Un Problema Mañana">
      <img src="{{ asset('build/img/logo.webp') }}" alt="Alcaldía de Armenia y Red Salud Armenia" class="brand-logo">
      <div class="brand-content">
        <span class="brand-campaign">Un Sorbito Hoy,</span>
        <h1>Un Problema Mañana</h1>
        <p>Prevención, educación y decisiones saludables</p>
      </div>
    </a>
    <section class="progress-card" aria-label="Progreso de participación">
      <div class="progress-header">
        <div class="progress-title">
          <div class="progress-icon"><i class="bi bi-signpost-2-fill"></i></div>
          <div><strong>Su recorrido</strong><span>Complete los siguientes pasos</span></div>
        </div>
        <div class="progress-count"><strong>1</strong> / 3</div>
      </div>
      <div class="progress-bar"><span class="progress-value"></span></div>
      <div class="progress-steps">
        <div class="progress-step active"><div class="step-circle"><i class="bi bi-person-fill"></i></div><div class="step-content"><strong>Sus datos</strong><span>Información básica</span></div></div>
        <div class="step-connector"></div>
        <div class="progress-step"><div class="step-circle"><i class="bi bi-person-badge-fill"></i></div><div class="step-content"><strong>Su avatar</strong><span>Elija su personaje</span></div></div>
        <div class="step-connector"></div>
        <div class="progress-step"><div class="step-circle"><i class="bi bi-stars"></i></div><div class="step-content"><strong>Comenzar</strong><span>Conozca la experiencia</span></div></div>
      </div>
    </section>
  </div>
</header>

<section class="intro">
  <span class="intro-label"><i class="bi bi-stars"></i> Antes de comenzar</span>
  <h2>Conozcámonos un poco</h2>
  <p>Esta información nos ayuda a conocer quiénes participan en la experiencia y en qué lugares se está realizando. Algunos datos podrán utilizarse posteriormente para generar estadísticas territoriales de participación.</p>
</section>

<section id="nosotros" class="about-program">
  <div class="about-program-icon"><i class="bi bi-info-circle"></i></div>
  <div class="about-program-content">
    <span class="about-program-label">Sobre el programa</span>
    <h3>¿Qué es Un Sorbito Hoy, Un Problema Mañana?</h3>
    <p>Es una experiencia educativa que busca brindar información y herramientas para comprender los riesgos relacionados con el consumo de alcohol en menores de edad.</p>
    <p>Durante el recorrido encontrará contenidos, situaciones y decisiones que le ayudarán a reconocer señales de alerta, reflexionar y aprender formas adecuadas de acompañar y brindar apoyo.</p>
    <div class="about-program-items">
      <div class="about-item"><i class="bi bi-lightbulb"></i><span>Aprende</span></div>
      <div class="about-item"><i class="bi bi-shield-check"></i><span>Previene</span></div>
      <div class="about-item"><i class="bi bi-chat-heart"></i><span>Acompaña</span></div>
    </div>
  </div>
</section>

<div class="participation-layout">

  <aside class="guide-panel" aria-label="Guía del recorrido">

    <div class="guide-label">
      <i class="bi bi-stars"></i>
      SU GUÍA
    </div>

    <div class="guide-bubble-large">
      <strong>¡Hola!</strong>
      <span>
        Te acompañaré durante este recorrido educativo.
        Completa la información solicitada y elige el personaje que te acompañará.
        Si prefieres participar sin datos de identificación, podrás conocer las condiciones antes de continuar.
      </span>
    </div>

    <audio
      id="guideAudio"
      preload="auto"
      src="{{ asset('build/audio/formulario.mp3') }}"
    ></audio>

    <div class="guide-audio-actions" aria-label="Controles de audio de la guía">
      <button
        type="button"
        id="guideAudioBtn"
        class="guide-audio-btn"
        aria-label="Repetir mensaje de la guía"
      >
        <i class="bi bi-volume-up-fill"></i>
        <span>Escuchar guía</span>
      </button>

      <button
        type="button"
        id="guideStopBtn"
        class="guide-stop-btn"
        aria-label="Detener la voz de la guía"
        disabled
      >
        <i class="bi bi-stop-fill"></i>
        <span>Detener</span>
      </button>
    </div>

    <span
      id="guideAudioStatus"
      class="guide-audio-status"
      aria-live="polite"
    ></span>

    <div class="guide-avatar-large">
      <img
        src="{{ asset('build/img/avatars/madre.webp') }}"
        alt="Guía de la plataforma"
      >
    </div>

  </aside>

  <div class="form-column">

    <div class="messages">
      @if(session('success'))<div class="alert alert-success"><i class="bi bi-check-circle-fill"></i><div>{{ session('success') }}</div></div>@endif
      @if(session('error'))<div class="alert alert-error"><i class="bi bi-exclamation-triangle-fill"></i><div>{{ session('error') }}</div></div>@endif
    </div>

    <form id="participacionForm" action="{{ route('participacion.store') }}" method="POST" class="form-card">
@csrf

<section class="form-section" id="datos-personales">
  <div class="section-heading">
    <div class="section-icon"><i class="bi bi-person"></i></div>
    <div><h3>Información personal</h3><p>Cuéntenos algunos datos básicos para registrar su participación.</p></div>
  </div>

  <div class="anonymous-option" id="anonymousOption">
    <div class="anonymous-option-icon"><i class="bi bi-incognito"></i></div>
    <div class="anonymous-option-content">
      <div class="anonymous-title">
        <strong>¿Cómo desea participar?</strong>
        <span>Puede continuar sin registrar datos de identificación. Antes de elegir esta modalidad, revise las funciones que estarán disponibles y la información general que seguirá solicitándose.</span>
      </div>
      <label class="anonymous-switch">
        {{-- El hidden va ANTES del checkbox: si comparten name, PHP toma el último valor. --}}
        <input type="hidden" name="es_anonimo" value="0">
        <input type="checkbox" id="es_anonimo" name="es_anonimo" value="1">
        <span class="anonymous-slider"></span>
        <span class="anonymous-label">Continuar sin datos de identificación</span>
      </label>
    </div>
  </div>

  <div class="fields-grid">
    <div class="field anonymous-field full">
      <label for="nombre_completo">Nombre completo <span class="required">*</span></label>
      <div class="input-wrap"><i class="bi bi-person input-icon"></i>
        <input type="text" id="nombre_completo" name="nombre_completo" class="form-control with-icon" placeholder="Escriba su nombre completo" value="{{ old('nombre_completo') }}" required></div>
      @error('nombre_completo')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field anonymous-field">
      <label for="tipo_documento">Tipo de documento <span class="required">*</span></label>
      <div class="input-wrap"><i class="bi bi-card-text input-icon"></i>
        <select id="tipo_documento" name="tipo_documento" class="form-select with-icon" required>
          <option value="">Seleccione una opción</option>
          @foreach(['CC'=>'Cédula de ciudadanía','TI'=>'Tarjeta de identidad','CE'=>'Cédula de extranjería','OTRO'=>'Otro'] as $v=>$t)
            <option value="{{ $v }}" {{ old('tipo_documento') == $v ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select></div>
      @error('tipo_documento')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field anonymous-field">
      <label for="numero_documento">Número de documento <span class="required">*</span></label>
      <div class="input-wrap"><i class="bi bi-credit-card input-icon"></i>
        <input type="text" id="numero_documento" name="numero_documento" class="form-control with-icon" placeholder="Número de documento" value="{{ old('numero_documento') }}" required></div>
      @error('numero_documento')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field">
      <label for="edad">Edad <span class="required">*</span></label>
      <div class="input-wrap"><i class="bi bi-calendar3 input-icon"></i>
        <input type="number" id="edad" name="edad" class="form-control with-icon" placeholder="Ej. 35" min="1" max="120" value="{{ old('edad') }}" required></div>
      @error('edad')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field anonymous-field">
      <label for="telefono">Teléfono</label>
      <div class="input-wrap"><i class="bi bi-telephone input-icon"></i>
        <input type="tel" id="telefono" name="telefono" class="form-control with-icon" placeholder="Número de contacto" value="{{ old('telefono') }}"></div>
      @error('telefono')<div class="field-error">{{ $message }}</div>@enderror
    </div>

    <div class="field anonymous-field full">
      <label for="correo">Correo electrónico</label>
      <div class="input-wrap"><i class="bi bi-envelope input-icon"></i>
        <input type="email" id="correo" name="correo" class="form-control with-icon" placeholder="ejemplo@correo.com" value="{{ old('correo') }}"></div>
      @error('correo')<div class="field-error">{{ $message }}</div>@enderror
    </div>
  </div>
</section>

<section class="form-section">
  <div class="section-heading">
    <div class="section-icon"><i class="bi bi-people"></i></div>
    <div><h3>Su relación con el entorno</h3><p>Esta información permite comprender el contexto de quienes participan.</p></div>
  </div>
  <div class="fields-grid">
    <div class="field">
      <label for="rol_familiar">¿Cuál es su relación familiar? <span class="required">*</span></label>
      <div class="input-wrap"><i class="bi bi-person-hearts input-icon"></i>
        <select id="rol_familiar" name="rol_familiar" class="form-select with-icon" required>
          <option value="">Seleccione una opción</option>
          @foreach([''=>'','Padre'=>'Padre','Madre'=>'Madre','Acudiente'=>'Acudiente','Hermano'=>'Hermano/a','Tio'=>'Tío/a','Primo'=>'Primo/a','Abuelo'=>'Abuelo/a','Otro'=>'Otro'] as $v=>$t)
            <option value="{{ $v }}" {{ old('rol_familiar') == $v ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select></div>
      @error('rol_familiar')<div class="field-error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
      <label for="institucion">Institución</label>
      <div class="input-wrap"><i class="bi bi-building input-icon"></i>
        <input type="text" id="institucion" name="institucion" class="form-control with-icon" placeholder="Colegio, universidad o institución" value="{{ old('institucion') }}"></div>
      @error('institucion')<div class="field-error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
      <label for="grado">Grado / nivel</label>
      <div class="input-wrap"><i class="bi bi-mortarboard input-icon"></i>
        <input type="text" id="grado" name="grado" class="form-control with-icon" placeholder="Ej. 10°, 11°, universitario" value="{{ old('grado') }}"></div>
      @error('grado')<div class="field-error">{{ $message }}</div>@enderror
    </div>
  </div>
</section>

<section class="form-section">
  <div class="section-heading">
    <div class="section-icon"><i class="bi bi-geo-alt"></i></div>
    <div><h3>¿Dónde realiza esta actividad?</h3><p>Intentaremos detectar automáticamente su ubicación para facilitar el registro.</p></div>
  </div>
  <div class="location-box">
    <div id="locationLoading" class="location-status loading">
      <div class="location-status-icon"><i class="bi bi-geo-alt location-loading"></i></div>
      <div class="location-status-content"><strong>Detectando ubicación...</strong><span>El navegador solicitará permiso para conocer su ubicación aproximada.</span></div>
    </div>
    <div id="locationDetected" class="location-status detected" style="display:none;">
      <div class="location-status-icon"><i class="bi bi-check-circle"></i></div>
      <div class="location-status-content"><strong>Ubicación detectada</strong><span id="locationDetectedText">Su ubicación fue identificada correctamente.</span></div>
    </div>
    <div id="locationManual" class="location-status manual" style="display:none;">
      <div class="location-status-icon"><i class="bi bi-pencil-square"></i></div>
      <div class="location-status-content"><strong>Registro manual</strong><span>Puede indicar manualmente el municipio y la zona donde realiza la actividad.</span></div>
    </div>

    <div class="fields-grid">
      <div class="field">
        <label for="municipio">Municipio <span class="required">*</span></label>
        <div class="input-wrap"><i class="bi bi-pin-map input-icon"></i>
          <input type="text" id="municipio" name="municipio" class="form-control with-icon" placeholder="Detectando..." value="{{ old('municipio') }}" required></div>
        @error('municipio')<div class="field-error">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label for="zona">Zona / sector <span class="required">*</span></label>
        <div class="input-wrap"><i class="bi bi-map input-icon"></i>
          <input type="text" id="zona" name="zona" class="form-control with-icon" placeholder="Ej. Centro, Norte, Sur..." value="{{ old('zona') }}" required></div>
        <div class="field-help">Puede indicar el barrio, sector o zona.</div>
        @error('zona')<div class="field-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <input type="hidden" id="latitud" name="latitud" value="{{ old('latitud') }}">
    <input type="hidden" id="longitud" name="longitud" value="{{ old('longitud') }}">
    <input type="hidden" id="ubicacion_metodo" name="ubicacion_metodo" value="{{ old('ubicacion_metodo') }}">
    <input type="hidden" id="precision_ubicacion" name="precision_ubicacion" value="{{ old('precision_ubicacion') }}">

    <div id="coordinatesContainer" class="coordinates" style="display:none;">
      <div class="coordinate"><span>Latitud</span><strong id="latitudVisual">—</strong></div>
      <div class="coordinate"><span>Longitud</span><strong id="longitudVisual">—</strong></div>
    </div>
    <div id="accuracyStatus" class="accuracy-status" aria-live="polite"></div>

    <div class="location-actions">
      <button type="button" id="btnDetectarUbicacion" class="location-btn primary"><i class="bi bi-crosshair"></i> Detectar mi ubicación</button>
      <button type="button" id="btnUbicacionManual" class="location-btn"><i class="bi bi-pencil"></i> Ingresar manualmente</button>
    </div>

    <div class="privacy-box">
      <i class="bi bi-shield-lock"></i>
      <p><strong>Su privacidad es importante.</strong> La ubicación se utilizará para generar estadísticas territoriales y posteriormente visualizar zonas de participación en un mapa de calor. No se realizará seguimiento continuo de su ubicación ni se mostrará públicamente su ubicación individual.</p>
    </div>
  </div>
</section>

<section class="form-section">
  <div class="section-heading">
    <div class="section-icon"><i class="bi bi-shield-check"></i></div>
    <div><h3>Autorización y privacidad</h3><p>Antes de continuar necesitamos confirmar su autorización.</p></div>
  </div>
  <div class="terms-preview">
    <div class="terms-preview-icon"><i class="bi bi-shield-check"></i></div>
    <div class="terms-preview-content">
      <strong>Antes de continuar</strong>
      <span>Revise de forma clara cómo utilizamos sus datos, la ubicación y la información de participación.</span>
      <button type="button" class="terms-btn" id="btnTerminos"><i class="bi bi-file-earmark-text"></i> Ver términos y condiciones</button>
    </div>
  </div>
  <div class="consent-box">
    <div class="check-row">
      <input type="checkbox" id="acepta_datos" name="acepta_datos" value="1" {{ old('acepta_datos') ? 'checked' : '' }} required>
      <label for="acepta_datos"><strong>Autorizo el tratamiento de los datos proporcionados para participar en Un Sorbito Hoy, Un Problema Mañana.</strong><br>He leído la información disponible sobre privacidad, tratamiento de datos y finalidades de uso.</label>
    </div>
    <div class="check-row">
      <input type="checkbox" id="acepta_ubicacion" name="acepta_ubicacion" value="1" {{ old('acepta_ubicacion') ? 'checked' : '' }} required>
      <label for="acepta_ubicacion"><strong>Autorizo el uso de la ubicación proporcionada.</strong><br>Comprendo que podrá utilizarse para generar estadísticas territoriales y mapas de participación agregados, sin seguimiento continuo de mis movimientos.</label>
    </div>
  </div>
</section>

<div class="form-footer">
  <div class="footer-info"><i class="bi bi-lock-fill"></i><span>Sus datos serán tratados de acuerdo con las condiciones de privacidad del programa.</span></div>

  <div class="form-actions">
    <button type="submit" class="submit-btn">
      <span>Guardar y elegir mi personaje</span>
      <i class="bi bi-arrow-right"></i>
    </button>
  </div>
</div>
    </form>

  </div>
</div>

<div class="terms-modal anonymous-warning-modal" id="anonymousWarningModal" aria-hidden="true">
  <div class="terms-overlay" id="anonymousWarningOverlay"></div>
  <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="anonymousWarningTitle" aria-describedby="anonymousWarningDescription">
    <div class="terms-header">
      <div class="terms-header-icon"><i class="bi bi-incognito"></i></div>
      <div class="terms-header-copy">
        <span>Antes de continuar</span>
        <h2 id="anonymousWarningTitle">Participación sin datos de identificación</h2>
      </div>
      <button type="button" class="terms-close" id="btnCerrarAvisoAnonimo" aria-label="Cerrar aviso"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="terms-body" id="anonymousWarningDescription">
      <div class="terms-notice"><i class="bi bi-info-circle-fill"></i><p>Puede realizar el recorrido educativo sin registrar nombre ni documento. Sin embargo, esta modalidad tiene algunas limitaciones.</p></div>
      <ul class="warning-list">
        <li><i class="bi bi-award"></i><div><strong>Certificado</strong><span>No podrás obtener un certificado individual si para generarlo es necesario verificar tu identidad.</span></div></li>
        <li><i class="bi bi-chat-left-text"></i><div><strong>Devolución personalizada</strong><span>No recibirás una devolución vinculada a tu identidad ni recomendaciones basadas en un perfil personal.</span></div></li>
        <li><i class="bi bi-graph-up-arrow"></i><div><strong>Historial de progreso</strong><span>Tu avance no quedará asociado a una cuenta personal, por lo que no podrás consultar un historial individual posteriormente.</span></div></li>
      </ul>
      <div class="anonymous-data-note"><strong>Ten presente:</strong> para elaborar estadísticas generales, el formulario todavía puede solicitar algunos datos de contexto, como edad, relación familiar y lugar donde se realiza la actividad. Por eso, esta opción evita datos de identificación directa, pero no significa que no se recopile ningún dato.</div>
    </div>
    <div class="terms-footer">
      <span>Un Sorbito Hoy, Un Problema Mañana · Tu participación es voluntaria.</span>
      <div class="anonymous-warning-actions">
        <button type="button" class="btn-register" id="btnElegirRegistro">Prefiero registrarme</button>
        <button type="button" class="btn-continue" id="btnContinuarAnonimo">Continuar sin identificarme <i class="bi bi-arrow-right"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="terms-modal" id="termsModal" aria-hidden="true">
  <div class="terms-overlay" id="termsOverlay"></div>
  <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="termsTitle">
    <div class="terms-header">
      <div class="terms-header-icon"><i class="bi bi-shield-lock"></i></div>
      <div class="terms-header-copy"><span>Información importante</span><h2 id="termsTitle">Términos, privacidad y ubicación</h2></div>
      <button type="button" class="terms-close" id="btnCerrarTerminos" aria-label="Cerrar términos y condiciones"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="terms-body">
      <div class="terms-notice"><i class="bi bi-info-circle-fill"></i><p>Antes de continuar, revise cómo se utilizará la información que proporcione en <strong>Un Sorbito Hoy, Un Problema Mañana</strong>.</p></div>

      <section class="terms-section"><h3><i class="bi bi-person-lock"></i> 1. Información que podemos solicitar</h3>
        <p>Dependiendo de la modalidad de participación, podremos solicitar datos básicos como nombre, edad, tipo y número de documento, teléfono, correo, institución educativa, grado, relación familiar y datos relacionados con el lugar donde se realiza la actividad.</p></section>

      <section class="terms-section"><h3><i class="bi bi-geo-alt"></i> 2. ¿Para qué usamos la ubicación?</h3>
        <p>La ubicación podrá obtenerse mediante la función de ubicación del dispositivo o mediante la información territorial que ingrese manualmente.</p>
        <p>Su finalidad es conocer, de manera general, dónde se realizan las actividades de Un Sorbito Hoy, Un Problema Mañana y generar estadísticas territoriales y mapas agregados de participación.</p>
        <div class="terms-highlight"><i class="bi bi-shield-check"></i><strong>No realizamos seguimiento continuo de sus movimientos ni utilizamos la ubicación para vigilar su desplazamiento.</strong></div></section>

      <section class="terms-section"><h3><i class="bi bi-bar-chart"></i> 3. Estadísticas y mapas</h3>
        <p>La información podrá utilizarse para elaborar estadísticas, indicadores y representaciones territoriales que permitan conocer el alcance de las actividades educativas.</p>
        <p>Los resultados destinados a consulta general deberán presentarse de forma agregada y no tendrán como finalidad identificar públicamente a una persona.</p></section>

      <section class="terms-section"><h3><i class="bi bi-mortarboard"></i> 4. Finalidad educativa</h3>
        <p>Un Sorbito Hoy, Un Problema Mañana es una herramienta educativa y de prevención orientada a brindar información y promover la reflexión sobre los riesgos relacionados con el consumo de alcohol en menores de edad.</p>
        <p>La plataforma no sustituye la atención, valoración u orientación de profesionales de salud, educación, protección o autoridades competentes cuando estas sean necesarias.</p></section>

      <section class="terms-section"><h3><i class="bi bi-database-lock"></i> 5. Tratamiento y protección de los datos</h3>
        <p>Los datos serán tratados para las finalidades informadas durante el proceso de participación y conforme a la normativa aplicable sobre protección de datos personales.</p>
        <p>Se deberán aplicar medidas razonables de seguridad para proteger la información frente a acceso, pérdida, alteración o uso no autorizado.</p></section>

      <section class="terms-section"><h3><i class="bi bi-person-check"></i> 6. Participación voluntaria</h3>
        <p>La participación es voluntaria. Antes de proporcionar información, puede revisar estas condiciones y decidir si desea continuar.</p></section>

      <section class="terms-section"><h3><i class="bi bi-people"></i> 7. Participación de menores de edad</h3>
        <p>Cuando la actividad involucre niños, niñas o adolescentes, se deberán aplicar las reglas correspondientes a la protección de sus datos personales y los mecanismos de autorización que correspondan según el caso.</p>
        <p>La información solicitada deberá limitarse a aquella necesaria para las finalidades informadas.</p></section>

      <section class="terms-section"><h3><i class="bi bi-person-vcard"></i> 8. Derechos sobre los datos</h3>
        <p>El titular de los datos podrá ejercer los derechos reconocidos por la legislación aplicable, incluyendo conocer, actualizar y rectificar la información y solicitar información sobre su tratamiento.</p></section>

      <section class="terms-section"><h3><i class="bi bi-building"></i> 9. Responsable del tratamiento</h3>
        <p><strong>Responsable:</strong> RED SALUD ARMENIA ESE - ALCALDIA DE ARMENIA</p>
        <p><strong>Correo:</strong> servicioalcliente@armenia.gov.co</p>
        <small>Estos datos deben corresponder al responsable real del tratamiento y completarse antes de poner la plataforma en producción.</small></section>

      <div class="terms-final-notice"><i class="bi bi-check-circle-fill"></i>
        <div><strong>Autorización informada</strong><p>Al marcar las casillas de autorización del formulario confirma que ha leído esta información y comprende las finalidades descritas para el tratamiento de los datos proporcionados.</p></div></div>
    </div>
    <div class="terms-footer">
      <span><i class="bi bi-lock-fill"></i> Un Sorbito Hoy, Un Problema Mañana · Información de privacidad</span>
      <button type="button" class="terms-accept-btn" id="btnAceptarTerminos">Entendido <i class="bi bi-check-lg"></i></button>
    </div>
  </div>
</div>

<footer class="page-footer">Un Sorbito Hoy, Un Problema Mañana · Aprende · Previene · Acompaña</footer>
</div>

<script>
const $ = id => document.getElementById(id);


/* =========================================================
   AUDIO DE LA GUÍA DESDE ARCHIVO MP3
========================================================= */

const guidePanel = document.querySelector('.guide-panel');
const guideAudioBtn = document.getElementById('guideAudioBtn');
const guideStopBtn = document.getElementById('guideStopBtn');
const guideAudioStatus = document.getElementById('guideAudioStatus');
const guideAudio = document.getElementById('guideAudio');

let guiaAudioIniciado = false;
let guiaAutoplayPendiente = true;

function actualizarEstadoGuia(reproduciendo) {
  if (!guidePanel || !guideAudioBtn || !guideAudioStatus) return;

  guidePanel.classList.toggle('guide-speaking', reproduciendo);
  guideAudioBtn.classList.toggle('playing', reproduciendo);

  if (guideStopBtn) {
    guideStopBtn.disabled = !reproduciendo;
  }

  if (reproduciendo) {
    guideAudioBtn.innerHTML = `
      <i class="bi bi-volume-up-fill"></i>
      <span>La guía está reproduciéndose...</span>
    `;
    guideAudioStatus.textContent = 'Escuchando a su guía';
    guideAudioStatus.classList.add('speaking');
  } else {
    guideAudioBtn.innerHTML = `
      <i class="bi bi-volume-up-fill"></i>
      <span>Escuchar guía</span>
    `;
    guideAudioStatus.classList.remove('speaking');
  }
}

async function reproducirGuia() {
  if (!guideAudio) return false;

  try {
    // Si el audio ya terminó, comienza nuevamente desde el inicio.
    if (guideAudio.ended) guideAudio.currentTime = 0;

    const resultado = guideAudio.play();
    if (resultado && typeof resultado.then === 'function') {
      await resultado;
    }

    guiaAudioIniciado = true;
    guiaAutoplayPendiente = false;
    actualizarEstadoGuia(true);
    return true;
  } catch (error) {
    // Los navegadores pueden bloquear el autoplay hasta que el usuario interactúe.
    if (guideAudioStatus) {
      guideAudioStatus.textContent = 'Pulsa «Escuchar guía» para reproducir el audio.';
    }
    actualizarEstadoGuia(false);
    return false;
  }
}

function detenerGuia() {
  guiaAutoplayPendiente = false;
  guiaAudioIniciado = false;

  if (guideAudio) {
    guideAudio.pause();
    guideAudio.currentTime = 0;
  }

  actualizarEstadoGuia(false);
  if (guideAudioStatus) guideAudioStatus.textContent = 'Audio detenido';
}

if (guideAudio) {
  guideAudio.addEventListener('play', () => actualizarEstadoGuia(true));
  guideAudio.addEventListener('ended', () => {
    guiaAudioIniciado = false;
    actualizarEstadoGuia(false);
    if (guideAudioStatus) guideAudioStatus.textContent = 'Audio finalizado';
  });
  guideAudio.addEventListener('pause', () => {
    if (!guideAudio.ended) actualizarEstadoGuia(false);
  });
  guideAudio.addEventListener('error', () => {
    actualizarEstadoGuia(false);
    if (guideAudioStatus) {
      guideAudioStatus.textContent = 'No se pudo cargar formulario.mp3. Verifica la ubicación del archivo.';
    }
  });
}

if (guideStopBtn) {
  guideStopBtn.addEventListener('click', function (event) {
    event.stopPropagation();
    detenerGuia();
  });
}

if (guideAudioBtn) {
  guideAudioBtn.addEventListener('click', function () {
    guiaAutoplayPendiente = false;
    reproducirGuia();
  });
}

function iniciarAutoplayGuia() {
  if (!guiaAudioIniciado && guiaAutoplayPendiente) {
    // Se intenta iniciar automáticamente; si el navegador lo bloquea,
    // el botón «Escuchar guía» permite reproducirlo con un clic.
    reproducirGuia();
  }
}

window.addEventListener('load', iniciarAutoplayGuia);
window.addEventListener('beforeunload', function () {
  if (guideAudio) guideAudio.pause();
});

const municipioInput = $('municipio'), zonaInput = $('zona'), latitudInput = $('latitud'),
      longitudInput = $('longitud'), metodoInput = $('ubicacion_metodo'),
      locationLoading = $('locationLoading'), locationDetected = $('locationDetected'),
      locationManual = $('locationManual'), locationDetectedText = $('locationDetectedText'),
      coordinatesContainer = $('coordinatesContainer');

function mostrarEstado(cual) {
  locationLoading.style.display = cual === 'carga' ? 'flex' : 'none';
  locationDetected.style.display = cual === 'detectado' ? 'flex' : 'none';
  locationManual.style.display = cual === 'manual' ? 'flex' : 'none';
}

async function obtenerMunicipio(lat, lng) {
  try {
    const url = 'https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=' +
      encodeURIComponent(lat) + '&longitude=' + encodeURIComponent(lng) + '&localityLanguage=es';
    const res = await fetch(url);
    if (!res.ok) throw new Error('No fue posible obtener la ubicación.');
    const d = await res.json();
    const ciudad = d.city || d.locality || d.principalSubdivision || '';
    if (ciudad) municipioInput.value = ciudad;
    return ciudad;
  } catch (e) { console.error('Error de geocodificación:', e); return ''; }
}

let watchIdUbicacion = null;
let mejorPrecisionUbicacion = Infinity;
let mejorPosicionUbicacion = null;
let temporizadorUbicacion = null;

const PRECISION_OBJETIVO = 50;  // metros: excelente precisión
const PRECISION_MAXIMA = 500;   // metros: máximo permitido para una ubicación próxima
const TIEMPO_MAXIMO_UBICACION = 60000; // 60 segundos para intentar mejorar la lectura

function mostrarPrecision(accuracy) {
  const accuracyStatus = $('accuracyStatus');
  const metros = Math.round(Number(accuracy));

  accuracyStatus.className = 'accuracy-status';

  if (metros <= PRECISION_OBJETIVO) {
    accuracyStatus.classList.add('ok');
    accuracyStatus.textContent = '✓ Ubicación precisa. Precisión aproximada: ' + metros + ' metros.';
  } else if (metros <= PRECISION_MAXIMA) {
    accuracyStatus.classList.add('warn');
    accuracyStatus.textContent = '⚠ Ubicación próxima. Precisión aproximada: ' + metros + ' metros (máximo permitido: 500 metros).';
  } else {
    accuracyStatus.classList.add('error');
    accuracyStatus.textContent = 'La ubicación es demasiado aproximada (' + metros + ' metros). Active la ubicación precisa e inténtelo nuevamente.';
  }
}

function detenerSeguimientoUbicacion() {
  if (watchIdUbicacion !== null) {
    navigator.geolocation.clearWatch(watchIdUbicacion);
    watchIdUbicacion = null;
  }
  if (temporizadorUbicacion !== null) {
    clearTimeout(temporizadorUbicacion);
    temporizadorUbicacion = null;
  }
}

async function procesarUbicacion(pos) {
  const lat = Number(pos.coords.latitude);
  const lng = Number(pos.coords.longitude);
  const accuracy = Number(pos.coords.accuracy);

  console.log('[Ponte Pilas] Latitud:', lat);
  console.log('[Ponte Pilas] Longitud:', lng);
  console.log('[Ponte Pilas] Precisión:', accuracy, 'metros');

  // Conservamos la mejor lectura recibida durante el intento.
  if (accuracy < mejorPrecisionUbicacion) {
    mejorPrecisionUbicacion = accuracy;
    mejorPosicionUbicacion = pos;
    mostrarPrecision(accuracy);

    const metros = Math.round(accuracy);
    const accuracyStatus = $('accuracyStatus');

    if (accuracy > PRECISION_OBJETIVO && accuracy <= PRECISION_MAXIMA) {
      accuracyStatus.className = 'accuracy-status warn';
      accuracyStatus.textContent = 'Mejor lectura: aproximadamente ' + metros + ' metros. Continuamos buscando una ubicación más cercana...';
    } else if (accuracy > PRECISION_MAXIMA) {
      accuracyStatus.className = 'accuracy-status warn';
      accuracyStatus.textContent = 'Lectura actual: aproximadamente ' + metros + ' metros. Continuamos buscando una ubicación dentro del área máxima de 500 metros...';
    }
  }

  // Si ya tenemos una lectura excelente, la usamos inmediatamente.
  if (accuracy <= PRECISION_OBJETIVO) {
    detenerSeguimientoUbicacion();
    await guardarPosicionPrecisa(pos);
  }
}

async function guardarPosicionPrecisa(pos) {
  const lat = Number(pos.coords.latitude);
  const lng = Number(pos.coords.longitude);
  const accuracy = Number(pos.coords.accuracy);

  if (!Number.isFinite(lat) || !Number.isFinite(lng) || !Number.isFinite(accuracy)) {
    manejarErrorUbicacion({ message: 'El navegador no entregó coordenadas válidas.' });
    return;
  }

  if (accuracy > PRECISION_MAXIMA) {
    metodoInput.value = 'manual';
    latitudInput.value = '';
    longitudInput.value = '';
    $('precision_ubicacion').value = '';
    coordinatesContainer.style.display = 'none';
    mostrarPrecision(accuracy);
    mostrarEstado('manual');
    locationManual.querySelector('span')?.replaceChildren(
      document.createTextNode('La ubicación obtenida supera el área máxima permitida de 500 metros. Active la ubicación precisa o ingrésela manualmente.')
    );
    return;
  }

  latitudInput.value = String(lat);
  longitudInput.value = String(lng);
  $('precision_ubicacion').value = String(accuracy);
  metodoInput.value = 'gps';

  $('latitudVisual').textContent = lat.toFixed(7);
  $('longitudVisual').textContent = lng.toFixed(7);
  coordinatesContainer.style.display = 'grid';
  mostrarPrecision(accuracy);

  municipioInput.placeholder = 'Identificando municipio...';
  const municipio = await obtenerMunicipio(lat, lng);

  mostrarEstado('detectado');
  if (municipio) {
    locationDetectedText.textContent =
      'Ubicación detectada en ' + municipio + '. Precisión aproximada: ' +
      Math.round(accuracy) + ' metros.';
  } else {
    locationDetectedText.textContent =
      'Coordenadas obtenidas correctamente. Precisión aproximada: ' +
      Math.round(accuracy) + ' metros.';
    municipioInput.placeholder = 'Escriba su municipio';
  }
}

function finalizarIntentoUbicacion() {
  detenerSeguimientoUbicacion();

  if (mejorPosicionUbicacion && mejorPrecisionUbicacion <= PRECISION_MAXIMA) {
    guardarPosicionPrecisa(mejorPosicionUbicacion);
    return;
  }

  const precision = Number.isFinite(mejorPrecisionUbicacion)
    ? Math.round(mejorPrecisionUbicacion)
    : null;

  metodoInput.value = 'manual';
  latitudInput.value = '';
  longitudInput.value = '';
  $('precision_ubicacion').value = '';
  coordinatesContainer.style.display = 'none';
  mostrarEstado('manual');

  const accuracyStatus = $('accuracyStatus');
  accuracyStatus.className = 'accuracy-status error';
  accuracyStatus.textContent = precision
    ? 'No se obtuvo una ubicación dentro del área máxima de 500 metros después de intentar durante 60 segundos. La mejor lectura fue de aproximadamente ' + precision + ' metros. Active la ubicación precisa y vuelva a intentarlo.'
    : 'No fue posible obtener una ubicación dentro del área máxima de 500 metros. Verifique los permisos de ubicación e inténtelo nuevamente.';
}

function manejarErrorUbicacion(error) {
  detenerSeguimientoUbicacion();
  console.warn('No fue posible obtener la ubicación:', error);
  metodoInput.value = 'manual';
  latitudInput.value = '';
  longitudInput.value = '';
  $('precision_ubicacion').value = '';
  municipioInput.placeholder = 'Escriba su municipio';
  municipioInput.disabled = false;
  zonaInput.disabled = false;
  coordinatesContainer.style.display = 'none';
  mostrarEstado('manual');

  const accuracyStatus = $('accuracyStatus');
  accuracyStatus.className = 'accuracy-status error';
  accuracyStatus.textContent = 'No fue posible obtener una ubicación precisa. Verifique los permisos de ubicación e inténtelo nuevamente.';
}

function detectarUbicacion() {
  if (!navigator.geolocation) {
    manejarErrorUbicacion({ message: 'Geolocalización no disponible.' });
    return;
  }

  detenerSeguimientoUbicacion();
  mejorPrecisionUbicacion = Infinity;
  mejorPosicionUbicacion = null;
  mostrarEstado('carga');

  const accuracyStatus = $('accuracyStatus');
  accuracyStatus.className = 'accuracy-status warn';
  accuracyStatus.textContent = 'Buscando la ubicación más precisa disponible...';

  const opciones = {
    enableHighAccuracy: true,
    timeout: TIEMPO_MAXIMO_UBICACION,
    maximumAge: 0
  };

  // watchPosition permite que el dispositivo mejore la lectura en lugar de aceptar inmediatamente una ubicación aproximada.
  watchIdUbicacion = navigator.geolocation.watchPosition(
    procesarUbicacion,
    manejarErrorUbicacion,
    opciones
  );

  temporizadorUbicacion = setTimeout(finalizarIntentoUbicacion, TIEMPO_MAXIMO_UBICACION);
}

/* Modal y comportamiento de participación sin datos de identificación */
const esAnonimo = $('es_anonimo'), anonymousOption = $('anonymousOption');
const camposAnonimos = document.querySelectorAll('.anonymous-field input, .anonymous-field select');
const anonymousWarningModal = $('anonymousWarningModal');
let focoAntesAvisoAnonimo = null;

// Guardar el estado original de required para restaurarlo al volver al registro.
camposAnonimos.forEach(campo => {
  campo.dataset.requiredOriginal = campo.required ? '1' : '0';
});

function actualizarModoAnonimo() {
  const anonimo = esAnonimo.checked;
  anonymousOption.classList.toggle('active', anonimo);
  camposAnonimos.forEach(campo => {
    const contenedor = campo.closest('.field');
    if (anonimo) {
      campo.disabled = true;
      campo.required = false;
      campo.value = '';
      contenedor.classList.add('anonymous-disabled');
    } else {
      campo.disabled = false;
      campo.required = campo.dataset.requiredOriginal === '1';
      contenedor.classList.remove('anonymous-disabled');
    }
  });
}

function abrirAvisoAnonimo() {
  focoAntesAvisoAnonimo = document.activeElement;
  anonymousWarningModal.classList.add('active');
  anonymousWarningModal.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
  $('btnContinuarAnonimo').focus();
}

function cerrarAvisoAnonimo({cancelar = false} = {}) {
  anonymousWarningModal.classList.remove('active');
  anonymousWarningModal.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
  if (cancelar) {
    esAnonimo.checked = false;
    actualizarModoAnonimo();
    esAnonimo.focus();
  } else if (focoAntesAvisoAnonimo && typeof focoAntesAvisoAnonimo.focus === 'function') {
    focoAntesAvisoAnonimo.focus();
  }
}

esAnonimo.addEventListener('change', () => {
  actualizarModoAnonimo();
  if (esAnonimo.checked) abrirAvisoAnonimo();
});
$('btnContinuarAnonimo').addEventListener('click', () => cerrarAvisoAnonimo());
$('btnElegirRegistro').addEventListener('click', () => cerrarAvisoAnonimo({cancelar: true}));
$('btnCerrarAvisoAnonimo').addEventListener('click', () => cerrarAvisoAnonimo({cancelar: true}));
$('anonymousWarningOverlay').addEventListener('click', () => cerrarAvisoAnonimo({cancelar: true}));
document.addEventListener('keydown', e => {
  if (e.key === 'Escape' && anonymousWarningModal.classList.contains('active')) {
    cerrarAvisoAnonimo({cancelar: true});
  }
});
actualizarModoAnonimo();

$('btnDetectarUbicacion').addEventListener('click', detectarUbicacion);
$('btnUbicacionManual').addEventListener('click', () => {
  mostrarEstado('manual'); metodoInput.value = 'manual';
  municipioInput.disabled = false; zonaInput.disabled = false; municipioInput.focus();
});

[municipioInput, zonaInput].forEach(input => input.addEventListener('input', function () {
  if (this.value.trim() !== '' && metodoInput.value !== 'gps') metodoInput.value = 'manual';
}));

/* Modal de términos */
const termsModal = $('termsModal');
function abrirTerminos() {
  termsModal.classList.add('active'); termsModal.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden'; $('btnCerrarTerminos').focus();
}
function cerrarTerminos() {
  termsModal.classList.remove('active'); termsModal.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = ''; $('btnTerminos').focus();
}
$('btnTerminos').addEventListener('click', abrirTerminos);
$('btnCerrarTerminos').addEventListener('click', cerrarTerminos);
$('btnAceptarTerminos').addEventListener('click', cerrarTerminos);
$('termsOverlay').addEventListener('click', cerrarTerminos);
document.addEventListener('keydown', e => {
  if (e.key === 'Escape' && termsModal.classList.contains('active')) cerrarTerminos();
});

/* Validación */
$('participacionForm').addEventListener('submit', function (event) {
  const metodo = metodoInput.value;
  const precision = Number($('precision_ubicacion').value);

  if (metodo === 'gps') {
    if (!latitudInput.value || !longitudInput.value || !Number.isFinite(precision) || precision > PRECISION_MAXIMA) {
      event.preventDefault();
      alert('La ubicación GPS debe estar dentro de un área máxima de 500 metros. Active la ubicación precisa y vuelva a detectarla, o ingrese la ubicación manualmente.');
      return;
    }
  }

  const chequeos = [
    [municipioInput, !municipioInput.value.trim(), 'Por favor indique el municipio donde realiza la actividad.'],
    [zonaInput, !zonaInput.value.trim(), 'Por favor indique la zona o sector donde realiza la actividad.'],
    [$('acepta_datos'), !$('acepta_datos').checked, 'Debe aceptar el tratamiento de los datos para continuar.'],
    [$('acepta_ubicacion'), !$('acepta_ubicacion').checked, 'Debe autorizar el uso de la ubicación para continuar.']
  ];
  for (const [el, falla, msg] of chequeos) {
    if (falla) { event.preventDefault(); el.focus(); alert(msg); return; }
  }
});

window.addEventListener('load', () => setTimeout(detectarUbicacion, 700));
</script>
</body>
</html>