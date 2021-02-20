function isPrima(start,end){
    let divider = 0;
    let temp= [];

    for (let i = start; i <= end; i++){
        let count = 0;
        for (let x = 1; x <= i ; x++) {
            if(i%x == 0  ){
                count++;
            }
        }    
        
        if (count==2){
            temp.push(i)
        }
    }
    return temp.join(" ")
}

console.log(isPrima(20,50))