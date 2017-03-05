//-- ALL DATA
{
"User": {
  "username": "11225468",
  "email": "test_rr@test.com",
  "state": 1
},
"People": {
  "firstname": "TEST_R",
  "secondname": "TEST_R",
  "document": "11225468",
  "address": "--",
  "number": 0,
  "depto": null,
  "block": null,
  "birthdate": "1981-01-01",
  "gender": 1,
  "phonenumber": "45522111"
},
"Taxowner": {
  "id": 143,
  "state": 1
},
"Cars": [
  {
    "Taxownerscar": {
      "carcode": "MMF455SR",
      "registerpermision": 11233,
      "decreenro": 0,
      "dateexpire": null,
      "dateactive": "2017-01-05",
      "descriptioncar": "Chevrolet - Corsa Classic - AA - Lleva objetos varios",
      "registerpermisionorigin": "San Miguel de Tucuman"
    }
  },
  {
    "Taxownerscar": {
      "carcode": "MMR455SR",
      "registerpermision": 2,
      "decreenro": 0,
      "dateexpire": null,
      "dateactive": "2017-01-05",
      "descriptioncar": "Citroen - Berlingo - AA - Lleva objetos varios",
      "registerpermisionorigin": "San Miguel de Tucuman"
    }
  }
],
"Drivers": [
  {
    "Taxownerdriver": {
      "licencenumber": 11225468,
      "state": 1,
      "fecvenclicence": "2020-01-01",
      "user_id": 16577
    },
    "People": {
      "firstname": "TEST_R",
      "secondname": "TEST_R",
      "document": "11225468",
      "address": "--",
      "number": 0,
      "depto": null,
      "block": null,
      "birthdate": "1981-01-01",
      "gender": 1,
      "phonenumber": "45522111"
    }
  },
  {
    "Taxownerdriver": {
      "licencenumber": 22225468,
      "state": 1,
      "fecvenclicence": "2020-01-01",
      "user_id": 16578
    },
    "People": {
      "firstname": "TEST_DRR",
      "secondname": "TEST_DRR",
      "document": "22225468",
      "address": "S/D",
      "number": 0,
      "depto": null,
      "block": null,
      "birthdate": "1981-07-07",
      "gender": 1,
      "phonenumber": "45544545"
    }
  }
]
}

//--CHANGED CARS
{
"User": {
  "email": "test_rr@test.com",
},
"Cars": [
  {
    "Taxownerscar": {
      "key_carcode": "MMF455SR",
      "carcode": "MMF455SRR",
      "registerpermision": 11233,
      "decreenro": 0,
      "dateexpire": null,
      "dateactive": "2017-01-05",
      "descriptioncar": "Chevrolet - Corsa Classic - AA - Lleva objetos varios",
      "registerpermisionorigin": "San Miguel de Tucuman"
    }
  },
  {
    "Taxownerscar": {
      "carcode": "MMR455SR",
      "carcode": "MMR455SR",
      "carcode": "MMR455SRRR",
      "registerpermision": 2,
      "decreenro": 0,
      "dateexpire": null,
      "dateactive": "2017-01-05",
      "descriptioncar": "Citroen - Berlingo - AA - Lleva objetos varios",
      "registerpermisionorigin": "San Miguel de Tucuman"
    }
  }
]
}
//--CHANGED driver
//-- ALL DATA
{
"User": {
  "email": "test_rr@test.com"
},
"Drivers": [
  {
    "Taxownerdriver": {
      "key_licencenumber": 11225468,
      "licencenumber": 11225433,
      "state": 1,
      "fecvenclicence": "2020-01-01",
      "user_id": 16577
    }
  },
  {
    "Taxownerdriver": {
      "key_licencenumber": 22225468,
      "licencenumber": 22225468,
      "state": 1,
      "fecvenclicence": "2020-01-01",
      "user_id": 16578
    }
  }
]
}
