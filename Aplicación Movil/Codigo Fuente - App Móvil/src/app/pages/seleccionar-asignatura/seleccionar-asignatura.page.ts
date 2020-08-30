import { Component, OnInit } from '@angular/core';
import { ApiserviceService } from '../../servicios/apiservice.service';
import { Router, ActivatedRoute } from '@angular/router';
@Component({
  selector: 'app-seleccionar-asignatura',
  templateUrl: './seleccionar-asignatura.page.html',
  styleUrls: ['./seleccionar-asignatura.page.scss'],
})
export class SeleccionarAsignaturaPage implements OnInit {
  asignaturas: any;
  idPlan: any;
  constructor(public servicio: ApiserviceService,   private router: Router,
    private route: ActivatedRoute) { 
      
    this.initializeItems(servicio);
  }
  
  initializeItems(servicio: ApiserviceService){
    this.route.queryParams.subscribe((params) => {
      this.idPlan = params['idPlan'];
      console.log("El plan que llegó: "+this.idPlan)
      servicio.getAsignaturas(this.idPlan).subscribe(
        data=> this.asignaturas = data,
        err=>console.log(err)
      );
    });
  }

  
  getItems(ev: any) {
    let valor: any;
     // Setea 'val' segun el valor de la search bar
     valor = ev.target.value;
    if(valor == ''){
      this.initializeItems(this.servicio);
    }
   //falta arreglar el caso del borrado de caracteres ev.detail.data === null ocurre cuando se borra
    if(ev.detail.data === null){
     console.log(ev.target.value)
     valor = ev.target.value
    }
    // Si el valor es una cadena vacia, no filtra los items
    if (valor && valor.trim() != '') {
     console.log("valor de busqueda"+valor);
     this.asignaturas = this.asignaturas.filter((item) => {
       return (item.nombre.toLowerCase().includes(valor.toLowerCase()));
       })
     }
   }

  ngOnInit() {

  }
  
  programas(idAsignatura){
    console.log("ID asignatura a enviar: "+idAsignatura)
    //console.log("this route "+this.route)
    this.router.navigate(['seleccionar-anio'], {queryParams: {idAsignatura: idAsignatura, idPlan: this.idPlan}});
    /*
    this.router.navigate([
      '//seleccionar-asignatura', { outlets: { SeleccionarCarreraPage: ['SeleccionarCarreraPage', idPlan] } }
    ], {relativeTo: this.route, skipLocationChange: true})*/
  }
  
}