const chai = window.chai
const expect = chai.expect

describe('getWinner', () => {
  it("should give the value of the winner, which is determined by the slice of the pie chart that falls at the arrow placed at 3 o'clock after the rotation", () => {
    expect(getWinner(0)).to.equal(1)
    expect(getWinner(90)).to.equal(1)
    expect(getWinner(91)).to.equal(5)
    expect(getWinner(95)).to.equal(5)
    expect(getWinner(98)).to.equal(5)
    expect(getWinner(99)).to.equal(4)
    expect(getWinner(113)).to.equal(4)
    expect(getWinner(126)).to.equal(4)
    expect(getWinner(127)).to.equal(3)
    expect(getWinner(145)).to.equal(3)
    expect(getWinner(162)).to.equal(3)
    expect(getWinner(163)).to.equal(2)
    expect(getWinner(217)).to.equal(2)
    expect(getWinner(270)).to.equal(2)
    expect(getWinner(271)).to.equal(1)
  })
})
