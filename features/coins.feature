Feature: Calculate coins for amount
  In order to calculate the the coins needed for an amount
  As a website user
  I need to be able to input an amount and see the coins

  Scenario: Inputting in bad data
    Given I am on "/"
    When I fill in "amount" with "abcd"
    And I press "calculate"
    Then I should see "The amount \"abcd\" has no coins"

  Scenario: Inputting valid data
    Given I am on "/"
    When I fill in "amount" with "7.73"
    And I press "calculate"
    Then the "table.coins .coin.coin-X2" element should contain "£2"
    And the "table.coins .coin.coin-X2 + td" element should contain "3"
    And the "table.coins .coin.coin-X1" element should contain "£1"
    And the "table.coins .coin.coin-X1 + td" element should contain "1"
    And the "table.coins .coin.coin-50p" element should contain "50p"
    And the "table.coins .coin.coin-50p + td" element should contain "1"
    And the "table.coins .coin.coin-20p" element should contain "20p"
    And the "table.coins .coin.coin-20p + td" element should contain "1"
    And the "table.coins .coin.coin-2p" element should contain "2p"
    And the "table.coins .coin.coin-2p + td" element should contain "1"
    And the "table.coins .coin.coin-1p" element should contain "1p"
    And the "table.coins .coin.coin-1p + td" element should contain "1"

  @javascript
  Scenario: Inputting valid data with lightbox
    Given I am on "/"
    When I fill in "amount" with "7.73"
    And I press "calculate"
    And I wait for the lighbox to appear
    Then the ".fancybox-outer table.coins .coin.coin-X2" element should contain "£2"
    And the ".fancybox-outer table.coins .coin.coin-X1" element should contain "£1"
    And the ".fancybox-outer table.coins .coin.coin-50p" element should contain "50p"
    And the ".fancybox-outer table.coins .coin.coin-20p" element should contain "20p"
    And the ".fancybox-outer table.coins .coin.coin-2p" element should contain "2p"
    And the ".fancybox-outer table.coins .coin.coin-1p" element should contain "1p"