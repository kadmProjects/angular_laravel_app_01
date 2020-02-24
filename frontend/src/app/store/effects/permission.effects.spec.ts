import { TestBed } from '@angular/core/testing';
import { provideMockActions } from '@ngrx/effects/testing';
import { Observable } from 'rxjs';

import { PermissionEffects } from './permission.effects';

describe('PermissionEffects', () => {
  let actions$: Observable<any>;
  let effects: PermissionEffects;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        PermissionEffects,
        provideMockActions(() => actions$)
      ]
    });

    effects = TestBed.get<PermissionEffects>(PermissionEffects);
  });

  it('should be created', () => {
    expect(effects).toBeTruthy();
  });
});
