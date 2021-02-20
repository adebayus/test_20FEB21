function pattert(end) {
    let temp =[]
    let col =[]
    let total = 1
    let start = 0;
    let count = 1;
    let base = 1;
    // temp.push(total);
    while (total < end){
        if (count==5){
            total-=start
            temp.push(total)
            base++
            start=base
            count=1;
        }else{
            total+=start
            temp.push(total)
            start++
        }
        count++
        

    }

    return temp
}

console.log(pattert(15))