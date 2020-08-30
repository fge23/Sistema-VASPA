import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { SeleccionarAsignaturaPage } from './seleccionar-asignatura.page';

describe('SeleccionarAsignaturaPage', () => {
  let component: SeleccionarAsignaturaPage;
  let fixture: ComponentFixture<SeleccionarAsignaturaPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SeleccionarAsignaturaPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(SeleccionarAsignaturaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
