import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { SeleccionarAnioPage } from './seleccionar-anio.page';

describe('SeleccionarAnioPage', () => {
  let component: SeleccionarAnioPage;
  let fixture: ComponentFixture<SeleccionarAnioPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SeleccionarAnioPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(SeleccionarAnioPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
