import { TestBed } from '@angular/core/testing';

import { HttpErorHandlerService } from './http-eror-handler.service';

describe('HttpErorHandlerService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: HttpErorHandlerService = TestBed.get(HttpErorHandlerService);
    expect(service).toBeTruthy();
  });
});
