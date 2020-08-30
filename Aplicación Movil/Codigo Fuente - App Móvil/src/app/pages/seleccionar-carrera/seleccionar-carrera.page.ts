import { Component, OnInit } from '@angular/core';
import { ApiserviceService } from '../../servicios/apiservice.service';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-seleccionar-carrera',
  templateUrl: './seleccionar-carrera.page.html',
  styleUrls: ['./seleccionar-carrera.page.scss'],
})
export class SeleccionarCarreraPage implements OnInit {
  carreras: any;
  constructor(public servicio: ApiserviceService, private router: Router,
    private route: ActivatedRoute) {
    this.initializeItems(servicio);
  }
  
  ngOnInit() {
  }

  initializeItems( servicio: ApiserviceService){
    servicio.getCarreras().subscribe(
      data=> this.carreras = data,
      err=>console.log(err)
    );
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
    this.carreras = this.carreras.filter((item) => {
      return (item.nombre.toLowerCase().includes(valor.toLowerCase()));
      })
    }
  }
  
  asignaturas(idPlan){
    console.log("ID plan a enviar: "+idPlan)
    //console.log("this route "+this.route)
    this.router.navigate(['seleccionar-asignatura'], {queryParams: {idPlan: idPlan}});
    /*
    this.router.navigate([
      '//seleccionar-asignatura', { outlets: { SeleccionarCarreraPage: ['SeleccionarCarreraPage', idPlan] } }
    ], {relativeTo: this.route, skipLocationChange: true})*/
  }
}