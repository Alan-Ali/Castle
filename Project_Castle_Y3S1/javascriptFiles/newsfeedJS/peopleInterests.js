class Ajax{
    constructor() {
 
    }

    dataGet(url, string, bool, fun) {
        $.ajax({
            type: "GET",
            url: url + "?" + string,
            async: bool,
            success: function (result) {
                fun(result);
            }
        });
    }
    dataPost(url, ob, bool, fun) {
        $.ajax({
            type: "POST",
            data: ob,
            url: url,
            async: bool,
            success: function (result) {
                fun(result);
            }
        });
    }

    // get ()  {return value};
}

class followers extends Ajax{
    constructor(){
        // holding people-interest-people 
        super();
        this.peopleInterest = document.getElementById('people-interest-people');
        this.newPeopleInterest = document.createElement('div');
        this.newPeopleInterest.innerHTML = this.peopleInterest.outerHTML;
        // this.newPeopleInterest.setAttribute('class', 'people-interest-people');

            // ^ holding follow parts in another div
            this.followParts = document.getElementsByClassName('follow-parts');
            this.newFollowParts = document.createElement('div');
            this.newFollowParts.innerHTML = this.followParts[0].outerHTML;
            // this.newFollowParts.setAttribute('class', 'follow-parts center');

                // ^ holding person holder in another div
                this.personHolder = document.getElementsByClassName('person-holder');
                this.newPersonHolder = document.createElement('div');
                this.newPersonHolder.innerHTML = this.personHolder[0].outerHTML;
                // this.newPersonHolder.setAttribute('class', 'person-holder');

                    // ^ holding person-data-holder in another div
                    this.personDataHolder = document.getElementsByClassName("person-data-holder");
                    this.newPersonDH = document.createElement('div');
                    this.newPersonDH.innerHTML = this.personDataHolder[0].outerHTML;
                    // this.newPersonDH.setAttribute('class', 'person-data-holder');

                    // ^ holding person-follow-holder in another div
                    this.personFollowHolder = document.getElementsByClassName('person-follow-holder');
                    this.newPersonFH = document.createElement('div');
                    this.newPersonFH.innerHTML = this.personFollowHolder[0].outerHTML;
                                // this.newPersonFH.setAttribute('class', 'person-follow-holder');
    }

    get peoI(){ return this.peopleInterest;}
    get nPeoI(){return this.newPeopleInterest;}

    get fp() { return this.followParts;}
    get nfp() {return this.newFollowParts;}

    get perH(){ return this.personHolder;}
    get nPerH() { return this.newPersonHolder;}

    get perDH() {return this.personDataHolder;}
    get nPerDH() { return this.newPersonDH;}

    get perFH() { return this.personFollowHolder;}
    get nPerDH() { return this.newPersonDH;}
}


// connect.dataPost("../../javascriptFiles/JSTests/dataGrabber.php", {"hello": 5}, true, function (result) {
//     console.log(result);
// })

// connect.peopleInterest.innerHTML += connect.newFollowParts.innerHTML;

function main(){
    var connect = new followers();
    connect.peoI.innerHTML = "";
    
    var url = "./peopleInterests.php", string = "", bool = true;
    connect.dataGet(url, string, bool, function(result){
        console.log(result);
    });

}main();



